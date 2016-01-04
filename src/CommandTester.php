<?php

namespace Danzabar\CLI;

use Danzabar\CLI\Application;
use Danzabar\CLI\Input\Input;
use Danzabar\CLI\Output\Output;

/**
 * The command tester class provides a base to test commands
 *
 * @package CLI
 * @subpackage Commands
 * @author Dan Cox
 */
class CommandTester
{

    /**
     * An Instance of the console application
     *
     * @var Object
     */
    protected $application;

    /**
     * The task:action command string
     *
     * @var string
     */
    protected $command;

    /**
     * The task class that gets returned by the application
     *
     * @var Object
     */
    protected $task;

    /**
     * The command params
     *
     * @var Array
     */
    protected $params;

    /**
     * The raw output
     *
     * @var Mixed
     */
    protected $output;

    /**
     * Load the application
     *
     * @return void
     */
    public function __construct($application = null)
    {
        $this->application = (!is_null($application) ? $application : new Application );
        $this->setInputOutput();
    }

    /**
     * Sets the new input and output classes
     *
     * @return void
     */
    public function setInputOutput()
    {
        $input = new Input('php://memory');
        $output = new Output('php://memory');

        $di = $this->application->getDI();
        $di->setShared('input', $input);
        $di->setShared('output', $output);
    }

    /**
     * Sets an input for questions and confirmation
     *
     * @return void
     */
    public function setInput($str)
    {
        $input = $this->application->getDI()->get('input');
        $input->mock($str);
    }

    /**
     * Execute the command
     *
     * @return void
     */
    public function execute($command = null, $params = array())
    {
        if (!is_null($command)) {
            $this->command = $command;
        }

        $args = array('cli', $this->command);

        foreach ($params as $key => $param) {
            $args[] = $this->formatArgument($key, $param);
        }

        $this->task = $this->application->start($args);

        // Get the output
        $this->output = $this->application->getDI()->get('output')->read();
    }

    /**
     * Formats arguments and options
     *
     * @return String
     */
    public function formatArgument($key, $param)
    {
        if (strpos($key, '-') !== false) {
            return $key.'="'.$param.'"';
        }

        return $param;
    }

    /**
     * Adds a command to the app
     *
     * @return void
     */
    public function add($command)
    {
        $this->application->add($command);
    }

    /**
     * Returns the output
     *
     * @return void
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Sets the task:action command
     *
     * @return $this
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Returns the current command
     *
     * @return String
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Returns the application class
     *
     * @return Object
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Returns the task object
     *
     * @return Object
     */
    public function getTask()
    {
        return $this->task;
    }
} // END class CommandTester
