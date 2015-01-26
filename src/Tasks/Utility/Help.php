<?php namespace Danzabar\CLI\Tasks\Utility;

use Danzabar\CLI\Tasks\Task;

/**
 * The Help task
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class Help extends Task
{
	/**
	 * Task name
	 *
	 * @var string
	 */
	protected $name = 'help';

	/**
	 * The description
	 *
	 * @var string
	 */
	protected $description = 'Returns a list of commands and helpful guide to running them.';

	/**
	 * The main action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function main()
	{

	}
	
} // END class Help extends Task
