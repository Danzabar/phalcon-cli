<?php

use Danzabar\CLI\Tasks\Task,
	Danzabar\CLI\Tasks\Traits,
	Danzabar\CLI\Input\InputArgument,
	Danzabar\CLI\Input\InputOption;

/**
 * A test command
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class FakeTask extends Task
{
	use Traits\Question,
		Traits\Confirmation;

	/**
	 * The name
	 *
	 * @var string
	 */
	protected $name = 'fake';

	/**
	 * The test description
	 *
	 * @var string
	 */
	protected $description = 'The test command provides no use, it has no purpose, it just exists.';

	/**
	 * Sets expected arguments and options either by task or by action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setup($action)
	{
		$this->argument->addExpected('error', InputArgument::Optional);
	}

	/**
	 * The main action for this command
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function main()
	{
		$this->output->writeln("<Comment>main action</Comment>");
	}

	/**
	 * Test action, no output
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function output()
	{
	}

	/**
	 * Task that tests basic question
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function askMe()
	{
		$answer = $this->ask('What is your name?');

		$this->output->writeln($answer);
	}

	/**
	 * A double question task
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function advAsk()
	{
		$prelim = $this->ask('Do you like questions?');

		if($prelim == 'yes')
		{
			$answer = $this->ask('Great, so whats your favourite question?');

			$this->output->writeln($answer);
		}
	}

	/**
	 * Task that asks a choice question
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function choiceQ()
	{
		$choices = Array('one', 'two', 'three');

		if(isset($this->argument->error))
		{
			$this->setChoiceError($this->argument->error);
		}

		$answer = $this->choice('Select one of the following:', $choices);

		if($answer)
		{
			$this->output->writeln("You have selected $answer");
		}		
	}

	/**
	 * Multiple Choice question
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function multiChoice()
	{
		$choices = Array('one', 'five', 'six', 'eight', 'five');

		$answers = $this->multipleChoice('Select two of the following:', $choices);

		if($answers)
		{
			foreach($answers as $answer)
			{
				$this->output->writeln("Selected $answer");
			}
		} 
	}

	/**
	 * The confirmation test action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function confirmation()
	{
		$confirm = $this->confirm();

		if($confirm)
		{
			$this->output->write("Thanks for confirming");
		} else
		{
			$this->output->write("Action cancelled");
		}
	}

	/**
	 * A confirmation with explicit set and values changed
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function explicitConfirm()
	{	
		$this->setConfirmationNo('no');
		$this->setConfirmationYes('yes');
		$this->setConfirmExplicit(TRUE);

		if(isset($this->argument->error))
		{
			$this->setInvalidConfirmationError($this->argument->error);
		}


		$confirm = $this->confirm("Please confirm that you wish to continue... (Yes|No)");

		if($confirm)
		{
			$this->output->writeln("Confirmed");
		} else
		{
			$this->output->writeln("Cancelled");
		}
	}

} // END class TestCommand extends Command
