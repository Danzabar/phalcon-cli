<?php namespace Danzabar\CLI\Input\Traits;

/**
 * The expectation trait adds functionality for classes that have expected variables/arguments
 *
 */
Trait ExpectationTrait
{
	/**
	 * An array of expected vars
	 *
	 * @var Array
	 */
	protected $expected;

	/**
	 * Adds an expected argument to the expected array 
	 *
	 * @return InputArgument
	 * @author Dan Cox
	 */
	public function addExpected($name, $requirements)
	{
		$this->expected[$name] = $requirements; 
		
		return $this;
	}

	/**
	 * Returns the expected Array
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function getExpected()
	{
		return $this->expected;
	}
}

