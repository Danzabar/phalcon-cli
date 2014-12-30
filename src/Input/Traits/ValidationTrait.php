<?php namespace Danzabar\CLI\Input\Traits;

use Danzabar\CLI\Input\Exceptions;


Trait ValidationTrait
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
	public function validate($key, $expected, $value)
	{
		$this->v_key = $key;

		if(!is_array($expected))
		{
			$expected = Array($expected);
		}

		foreach($expected as $rule)
		{
			if(method_exists($this, "validate_$rule"))
			{
				call_user_func_array(Array($this, "validate_$rule"), Array($value));
			} else
			{
				// Missing rule method exception
				throw new Exceptions\IncorrectValidationMethodException($rule);
			}
		}
		
	}

	/**
	 * Just so theres a method for it, returns true in all cases
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function validate_optional($value)
	{
		return true;
	}

	/**
	 * Validation for required elements
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function validate_required($value)
	{
		if(!is_null($value) && $value !== '')
		{
			return true;
		}

		throw new Exceptions\RequiredValueMissingException($this->v_type, $this->v_key);
	}

}
