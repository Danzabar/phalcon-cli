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
	 * The input Stream
	 *
	 * @var string
	 */
	protected $inputStream;

	/**
	 * Set up the input
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($str)
	{
		$this->inputStream = fopen('php://memory', 'r+', false);

		fputs($this->inputStream, $str);

		rewind($this->inputStream);
	}

	/**
	 * Return the input str
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getInput()
	{
		$this->input = fgets($this->inputStream);

		return trim($this->input);
	}


} // END class InputMock
