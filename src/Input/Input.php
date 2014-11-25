<?php namespace Danzabar\CLI\Input;

/**
 * The input stream from the console
 *
 * @package CLI
 * @subpackage Input
 * @author Dan Cox
 */
class Input
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
		$this->inputStream = fopen("php://stdin", "r");
	}

	/**
	 * Read the input stream
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function read()
	{
		while(!feof($this->inputStream))
		{
			$this->input .= fgets($this->inputStream, 4064);
		}
	}

	/**
	 * Returns the raw captured input
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getInput()
	{
		return $this->input;
	}

} // END class Input
