<?php

use Danzabar\CLI\Tasks\Task;
use Danzabar\CLI\Input\InputArgument;
use Danzabar\CLI\Input\InputOption;

/**
 * A test command
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class FakeTask extends Task
{
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
        $this->argument->addExpected('error', InputArgument::OPTIONAL);
    }

    /**
     * The main action for this command
     *
     * @Action
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
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function output()
    {
    }

    /**
     * Task that tests basic question
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function askMe()
    {
        $question = $this->helpers->load('question');
        $answer = $question->ask('What is your name?');

        $this->output->writeln($answer);
    }

    /**
     * A double question task
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function advAsk()
    {
        $question = $this->helpers->load('question');
        $prelim = $question->ask('Do you like questions?');

        if ($prelim == 'yes') {
            $answer = $question->ask('Great, so whats your favourite question?');

            $this->output->writeln($answer);
        }
    }

    /**
     * Task that asks a choice question
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function choiceQ()
    {
        $question = $this->helpers->load('question');

        $choices = array('one', 'two', 'three');

        if (isset($this->argument->error)) {
            $question->setChoiceError($this->argument->error);
        }

        $answer = $question->choice('Select one of the following:', $choices);

        if ($answer) {
            $this->output->writeln("You have selected $answer");
        }
    }

    /**
     * Multiple Choice question
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function multiChoice()
    {
        $question = $this->helpers->load('question');

        $choices = array('one', 'five', 'six', 'eight', 'five');

        $answers = $question->multipleChoice('Select two of the following:', $choices);

        if ($answers) {
            foreach ($answers as $answer) {
                $this->output->writeln("Selected $answer");
            }
        }
    }

    /**
     * The confirmation test action
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function confirmation()
    {
        $confirmation = $this->helpers->load('confirm');

        $confirm = $confirmation->confirm();

        if ($confirm) {
            $this->output->write("Thanks for confirming");
        } else {
            $this->output->write("Action cancelled");
        }
    }

    /**
     * A confirmation with explicit set and values changed
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function explicitConfirm()
    {
        $confirmation = $this->helpers->load('confirm');

        $confirmation->setConfirmationNo('no');
        $confirmation->setConfirmationYes('yes');
        $confirmation->setConfirmExplicit(true);

        if (isset($this->argument->error)) {
            $confirmation->setInvalidConfirmationError($this->argument->error);
        }

        $confirm = $confirmation->confirm("Please confirm that you wish to continue... (Yes|No)");

        if ($confirm) {
            $this->output->writeln("Confirmed");
        } else {
            $this->output->writeln("Cancelled");
        }
    }
} // END class TestCommand extends Command
