<?php namespace Danzabar\CLI;

use \Phalcon\CLI\Task;

/**
 * The command class deals with executing CLI based commands, through phalcon task
 *
 * @package CLI
 * @subpackage Command
 * @author Dan Cox
 */
class Command extends Task
{
	
	/**
	 * The command name
	 *
	 * @var string
	 */
	protected $name;
	
	/**
	 * The command description
	 *
	 * @var string
	 */
	protected $description;

	
	/**
	 * The help task uses information based on the current child command class to output useful information.
	 *
	 * @return string
	 * @author Dan Cox
	 */
	public function helpTask()
	{
		$this->output->writeln($this->name);
		$this->output->writeln($this->description);
	}

	/**
	 * Returns the output instance
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getOutput()
	{
		return $this->output;
	}

	/**
	 * Returns the input instance
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getInput()
	{
		return $this->input;
	}


} // END class Command extends Task
