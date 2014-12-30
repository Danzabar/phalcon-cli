<?php

use Danzabar\CLI\Command,
	Danzabar\CLI\Traits,
	Danzabar\CLI\Input\InputArgument,
	Danzabar\CLI\Input\InputOption;

/**
 * The input task for testing input
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class InputTask extends Command
{
	/**
	 * Setup required arguments and options
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setup($task)
	{
		$this->option->addExpected('verbose', InputOption::Optional);
	}

	/**
	 * The main action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function mainAction()
	{
		if(isset($this->option->verbose))
		{
			$this->output->writeln('verbose mode activated');
		} else
		{
			$this->output->writeln('...');
		}
	}

} // END class InputTask extends Command

