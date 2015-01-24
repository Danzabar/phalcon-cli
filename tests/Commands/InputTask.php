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
	 * @return void
	 * @author Dan Cox
	 */
	public function setup($action)
	{
		switch($action)
		{
			case 'main':
				$this->option->addExpected('verbose', InputOption::Optional);
				break;
			case 'required':
				$this->argument->addExpected('email', InputArgument::Required);
				break;
			case 'exceptionTest':
				$this->argument->addExpected('value', 'string');
				break;
			case 'validation':
				$this->argument->addExpected('value', Array(InputArgument::Optional, InputArgument::Alpha));
				break;
		}
	}

	/**
	 * The main action
	 *
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
	 * Test for invalid validation exception
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function exceptionTest()
	{
		$this->output->writeln('no Exception!');
	}


} // END class InputTask extends Command

