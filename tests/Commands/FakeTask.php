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
	use Traits\Question;

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
		$this->output->writeln("main action");
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




} // END class TestCommand extends Command
