<?php

use Danzabar\CLI\Tasks\Task;
use Danzabar\CLI\Input\InputArgument;
use Danzabar\CLI\Input\InputOption;

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
        switch ($action) {
            case 'required':
                $this->argument->addExpected('email', InputArgument::REQUIRED);
                break;
            case 'validation':
                $this->argument->addExpected('value', array(InputArgument::OPTIONAL, InputArgument::ALPHA));
                break;
        }
    }

    /**
     * Setup function specifically for the main action
     *
     * @return void
     * @author Dan Cox
     */
    public function setupMain()
    {
        $this->option->addExpected('verbose', InputOption::OPTIONAL);
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
        if (isset($this->option->verbose)) {
            $this->output->writeln('verbose mode activated');
        } else {
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
        if (isset($this->argument->value)) {
            $this->output->writeln($this->argument->value);
        }

        $this->output->writeln('No argument passed');
    }

    /**
     * Setup function specific to options action
     *
     * @return void
     * @author Dan Cox
     */
    public function setupOptions()
    {
        $this->option->addExpected('name', InputOption::VALUEREQUIRED);
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

    /**
     * undocumented function
     *
     * @return void
     * @author Dan Cox
     */
    public function setupIntTest()
    {
        $this->argument->addExpected('int', [InputArgument::REQUIRED, InputArgument::INT]);
    }

    /**
     * Testing int validation
     *
     * @Action
     * @return void
     * @author Dan Cox
     */
    public function intTest()
    {
        $this->output->writeln('Passed');
    }
} // END class InputTask extends Command
