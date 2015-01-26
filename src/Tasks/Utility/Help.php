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
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function main()
	{
		$this->listCommands();	
	}

	/**
	 * Lists out command names and descriptions
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function listCommands()
	{
		$commands = $this->library->getAll();
		
		foreach($commands as $name => $details)
		{
			$this->output->writeln(ucwords($name));
			$this->output->hr(strlen($details['description']), '-');
			$this->output->writeln($details['description']);
			$this->output->hr(strlen($details['description']), '-');
			
			foreach($details['actions'] as $action)
			{
				$this->output->writeln($action);	
			}
			
			// Just for padding
			$this->output->writeln('');
		}	
	}
	
} // END class Help extends Task
