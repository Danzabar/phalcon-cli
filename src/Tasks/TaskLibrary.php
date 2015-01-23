<?php namespace Danzabar\CLI\Tasks;

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
	 * @author Dan Cox
	 */
	public function __construct()
	{
		$this->library = Array();
	}

	/**
	 * Adds a record to the library
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function add($tasks)
	{
		$this->library[$tasks['task']['name']] = Array('actions' => $tasks['task']['actions'], 'class' => $tasks['class']);		
	}

	/**
	 * Find a command by task:action name
	 *
	 * @return Object
	 * @author Dan Cox
	 */
	public function find($name)
	{
		$exp = explode(':', $name);
		$task = $exp[0];
		$action = $exp[1];

		if(array_key_exists($task, $this->library))
		{
			if(in_array($action, $this->library[$task]['actions']))
			{
				return $this->library[$task]['class'];
			}
		}

		// Not sure whether to throw an exception here?
		throw new Exceptions\CommandNotFoundException($name);
	}


} // END class TaskLibrary
