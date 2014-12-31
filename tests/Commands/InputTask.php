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
	public function setup($action)
	{
		switch($action)
		{
			case 'mainAction':
				$this->option->addExpected('verbose', InputOption::Optional);
				break;
			case 'requiredAction':
				$this->argument->addExpected('email', InputArgument::Required);
				break;
		}
	

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

	/**
	 * Another action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function requiredAction()
	{
		$this->output->writeln($this->argument->email);
	}

} // END class InputTask extends Command

