<?php namespace Danzabar\CLI\Output;

/**
 * The output class writes to the console.
 *
 * @package CLI
 * @subpackage Output
 * @author Dan Cox
 */
class Output
{
	/**
	 * The STDOut
	 *
	 * @var Resource
	 */
	protected $output;

	/**
	 * Build the output
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct()
	{
		$this->output = fopen("php://output", "w");
	}

	/**
	 * Output a string
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function write($str)
	{
		fputs($this->output, $str);
	}

	/**
	 * Write a single line
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function writeln($str)
	{
		fputs($this->output, $str."\n");
	}

	/**
	 * Close the output stream
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function close()
	{
		fclose($this->output);
	}


} // END class Output
