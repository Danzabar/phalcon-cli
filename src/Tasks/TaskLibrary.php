<?php

namespace Danzabar\CLI\Tasks;

use Danzabar\CLI\Tasks\Exceptions;

/**
 * The task library is used by the application class to store and fetch tasks
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class TaskLibrary
{
    /**
     * An Associative array of tasks
     *
     * @var Array
     */
    protected $library;

    /**
     * Set up class vars
     *
     * @return void
     */
    public function __construct()
    {
        $this->library = array();
    }

    /**
     * Adds a record to the library
     *
     * @return void
     */
    public function add($tasks)
    {
        $this->library[strtolower($tasks['task']['name'])] = array(
            'actions' => $tasks['task']['actions'],
            'description' => $tasks['task']['description'],
            'class' => $tasks['class']
        );
    }

    /**
     * Find a command by task:action name
     *
     * @return Object
     */
    public function find($name)
    {
        $exp = explode(':', $name);
        $task = strtolower($exp[0]);
        $action = $exp[1];

        if (array_key_exists($task, $this->library)) {
            if (in_array($action, $this->library[$task]['actions'])) {
                return $this->library[$task]['class'];
            }
        }

        throw new Exceptions\CommandNotFoundException($name);
    }

    /**
     * Returns the entry for a single task
     *
     * @param String $task - The task name
     * @return Array
     */
    public function get($task)
    {
        if (array_key_exists($task, $this->library)) {
            return $this->library[$task];
        }

        throw new Exceptions\CommandNotFoundException($task);
    }

    /**
     * Returns all the registered commands
     *
     * @return Array
     */
    public function getAll()
    {
        return $this->library;
    }
} // END class TaskLibrary
