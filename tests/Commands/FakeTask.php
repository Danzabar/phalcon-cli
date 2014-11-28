<?php

use Danzabar\CLI\Command;
use Danzabar\CLI\Traits;

/**
 * A test command
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class FakeTask extends Command
{
	use Traits\Question,
		Traits\Confirmation;

	/**
	 * The name
	 *
	 * @var string
	 */
	protected $name = 'Test command';

	/**
	 * The test description
	 *
	 * @var string
	 */
	protected $description = 'The test command provides no use, it has no purpose, it just exists.';

	/**
	 * The main action for this command
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function mainAction()
	{
		$this->output->writeln("<Comment>main action</Comment>");
	}

	/**
	 * Test action, no output
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function outputAction()
	{
	}

	/**
	 * Task that tests basic question
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function askAction()
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
	public function advAskAction()
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
	public function choiceAction(Array $params)
	{
		$choices = Array('one', 'two', 'three');

		if(!empty($params))
		{
			$this->setChoiceError($params[0]);
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
	public function multiChoiceAction()
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
	public function confirmationAction()
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
	public function explicitConfirmAction(Array $params)
	{	
		$this->setConfirmationNo('no');
		$this->setConfirmationYes('yes');
		$this->setConfirmExplicit(TRUE);

		if(!empty($params))
		{
			$this->setInvalidConfirmationError($params[0]);
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
