<?php namespace Danzabar\CLI\Input\Traits;

use Danzabar\CLI\Input\Exceptions;

trait ValidationTrait
{

    /**
     * The current param key
     *
     * @var string
     */
    protected $v_key;

    /**
     * undocumented function
     *
     * @return void
     * @author Dan Cox
     */
    public function validate($key, $value)
    {
        $this->v_key = $key;

        $expected = static::$expected[$key];

        if (!is_array($expected)) {
            $expected = array($expected);
        }

        // if it has optional rule and theres no value
        if (in_array('optional', $expected) && ($value == '' || is_null($value))) {
            return $value;
        }

        foreach ($expected as $rule) {
            if (method_exists($this, "$rule")) {
                $value = call_user_func_array(array($this, "$rule"), array($value));

            } else {
                // Missing rule method exception
                throw new Exceptions\IncorrectValidationMethodException($rule);
            }
        }

        return $value;
    }

    /**
     * Just so theres a method for it, returns the value in all cases
     *
     * @return Mixed
     * @author Dan Cox
     */
    public function optional($value)
    {
        return $value;
    }

    /**
     * Validation for required elements
     *
     * @return Mixed
     * @author Dan Cox
     */
    public function required($value)
    {
        if (!is_null($value) && $value !== '') {
            return $value;
        }

        throw new Exceptions\RequiredValueMissingException($this->v_type, $this->v_key);
    }

    /**
     * Validation for options to specify that a value is required and not just flag
     *
     * @return Mixed
     * @author Dan Cox
     */
    public function valueRequired($value)
    {
        if (is_string($value) || is_numeric($value)) {
            return $value;
        }

        throw new Exceptions\RequiredValueMissingException($this->v_type, $this->v_key);
    }

    /**
     * Checks that the string contains only alpha characters
     *
     * @return Mixed
     * @author Dan Cox
     */
    public function alpha($value)
    {
        if (ctype_alpha($value)) {
            return $value;
        }
        
        throw new Exceptions\ValidationFailException($value, 'Alpha');
    }

    /**
     * Value can only be an int
     *
     * @return Mixed
     * @author Dan Cox
     */
    public function int($value)
    {
        if (is_numeric($value)) {
            return $value;
        }

        throw new Exceptions\ValidationFailException($value, 'Numeric');
    }
}
