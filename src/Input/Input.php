<?php namespace Danzabar\CLI\Input;

use Danzabar\CLI\Input\InputInterface;

/**
 * The input stream from the console
 *
 * @package CLI
 * @subpackage Input
 * @author Dan Cox
 */ 
class Input implements InputInterface
{

	/**
	 * The STDIn resource
	 *
	 * @var Resource
	 */
	protected $inputStream;

	
	/**
	 * The raw input captured through STDIn
	 *
	 * @var string
	 */
	protected $input;


	/**
	 * Create the stream
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct()
	{
		$this->inputStream = fopen("php://stdin", "r+", false);
	}

	/**
	 * Read the input stream
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function read()
	{
		$this->input = fgets($this->inputStream);
		
		fclose($this->inputStream);

		return true;
	}

	/**
	 * Returns the raw captured input
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getInput()
	{
		$this->read();

		return $this->input;
	}

} // END class Input
