<?php namespace Danzabar\CLI\Input\Exceptions;

/**
 * The exception class for when a validation method fails
 *
 * @package CLI
 * @subpackage Input\Exceptions
 * @author Dan Cox
 */
class ValidationFailException extends \Exception
{
    /**
     * The tested value
     *
     * @var string
     */
    protected $value;

    /**
     * The tried method
     *
     * @var string
     */
    protected $method;

    /**
     * Fire exception
     *
     * @return void
     * @author Dan Cox
     */
    public function __construct($value, $method, $code = 0, \Exception $previous = null)
    {
        $this->value = $value;
        $this->method = $method;

        parent::__construct("Validation method $method failed on value $value", $code, $previous);
    }

    /**
     * Returns the value
     *
     * @return String
     * @author Dan Cox
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the method
     *
     * @return String
     * @author Dan Cox
     */
    public function getMethod()
    {
        return $this->method;
    }
} // END class ValidationFailException extends \Exception
