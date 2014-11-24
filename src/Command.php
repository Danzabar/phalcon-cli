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
		printf("%s \n %s", $this->name, $this->description);
	}
	


} // END class Command extends Task
