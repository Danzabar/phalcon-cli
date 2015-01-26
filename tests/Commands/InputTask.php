<?php

use Danzabar\CLI\Tasks\Task,
	Danzabar\CLI\Input\InputArgument,
	Danzabar\CLI\Input\InputOption;

/**
 * The input task for testing input
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class InputTask extends Task
{
	
	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name = 'Input';

	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description = 'Command to help test input arguments and options';

	/**
	 * Setup required arguments and options
	 *
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function setup($action)
	{
		switch($action)
		{
			case 'required':
				$this->argument->addExpected('email', InputArgument::Required);
				break;
			case 'validation':
				$this->argument->addExpected('value', Array(InputArgument::Optional, InputArgument::Alpha));
				break;
		}
	}

	/**
	 * Setup function specifically for the main action
	 *
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function setupMain()
	{
		$this->option->addExpected('verbose', InputOption::Optional);
	}
		

	/**
	 * The main action
	 *
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function main()
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
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function required()
	{
		$this->output->writeln($this->argument->email);
	}

	/**
	 * Action to test validation
	 *
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function validation()
	{
		if(isset($this->argument->value))
		{
			$this->output->writeln($this->argument->value);
		}

		$this->output->writeln('No argument passed');
	}

	/**
	 * Setup function specific to options action
	 *
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function setupOptions()
	{
		$this->option->addExpected('name', InputOption::ValueRequired);
	}

	/**
	 * Action to test options
	 *
	 * @Action
	 * @return void
	 * @author Dan Cox
	 */
	public function options()
	{
		$this->output->writeln($this->option->name);
	}

} // END class InputTask extends Command
