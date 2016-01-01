<?php namespace Danzabar\CLI\Tasks;

use \Phalcon\CLI\Task as PhalTask;

/**
 * The command class deals with executing CLI based commands, through phalcon task
 *
 * @package CLI
 * @subpackage Command
 * @author Dan Cox
 */
class Task extends PhalTask
{

    /**
     * The command name
     *
     * @var string
     */
    protected $name;

    /**
     * The command description
     *
     * @var string
     */
    protected $description;

    /**
     * Returns the output instance
     *
     * @return Output
     * @author Dan Cox
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Returns the input instance
     *
     * @return Input
     * @author Dan Cox
     */
    public function getInput()
    {
        return $this->input;
    }
} // END class Command extends Task
