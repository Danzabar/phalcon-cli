<?php namespace Danzabar\CLI\Input;

use Danzabar\CLI\Input\InputInterface;


/**
 * The input mock class is used to mock user input on tests
 *
 * @package CLI
 * @subpackage Test
 * @author Dan Cox
 */
class InputMock implements InputInterface
{
	
	/**
	 * An input string
	 *
	 * @var string
	 */
	protected $input;

	/**
	 * Set up the input
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($str)
	{
		$this->input = $str;
	}

	/**
	 * Return the input str
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getInput()
	{
		return $this->input;
	}


} // END class InputMock
