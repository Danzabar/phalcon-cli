<?php namespace Danzabar\CLI\Output;

use Danzabar\CLI\Output\OutputInterface;

/**
 * The output class writes to the console.
 *
 * @package CLI
 * @subpackage Output
 * @author Dan Cox
 */
class Output implements OutputInterface
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

} // END class Output
