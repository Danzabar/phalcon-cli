<?php namespace Danzabar\CLI;

use Phalcon\CLI\Dispatcher,
	Danzabar\CLI\Output\Output,
	Danzabar\CLI\Input\Input,
	Danzabar\CLI\Tasks\TaskPrepper,
	Danzabar\CLI\Tasks\TaskLibrary,
	Phalcon\DI;


/**
 * The Application class for CLI commands
 *
 * @package CLI
 * @subpackage Application
 * @author Dan Cox
 */
class Application
{
	/**
	 * The Dependancy object
	 *
	 * @var Object
	 */
	protected $di;

	/**
	 * Instance of the dispatcher
	 *
	 * @var Object
	 */
	protected $dispatcher;

	/**
	 * The raw set of arguments from the CLI
	 *
	 * @var Array
	 */
	protected $arguments;

	/**
	 * The task Prepper instance
	 *
	 * @var Object
	 */
	protected $prepper;

	/**
	 * Instance of the task library
	 *
	 * @var Object
	 */
	protected $library;

	/**
	 * The name of the CLI
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * The version of the CLI
	 *
	 * @var string
	 */
	protected $version;

	/**
	 * The phalcon console object
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($DI = NULL, $dispatcher = NULL, $library = NULL)
	{
		$this->di = (!is_null($DI) ? $DI : new DI);
		$this->dispatcher = (!is_null($dispatcher) ? $dispatcher : new Dispatcher);
		$this->library = (!is_null($library) ? $library : new TaskLibrary);

		// Set the defaults for the dispatcher
		$this->dispatcher->setDefaultTask('Help');
		$this->dispatcher->setDefaultAction('list');

		// Set no suffixes
		$this->dispatcher->setTaskSuffix('');
		$this->dispatcher->setActionSuffix('');
	
		// Add the output and input streams to the DI
		$this->di->setShared('output', new Output);
		$this->di->setShared('input', new Input);
		
		$this->prepper = new TaskPrepper($this->di);
	}

	/**
	 * Start the app
	 *
	 * @return Output
	 * @author Dan Cox
	 */
	public function start($args = Array())
	{
		$arg = $this->formatArgs($args);

		/**
		 * Arguments and Options
		 *
		 */
		$this->prepper
			 ->load($arg['task'])
			 ->loadParams($arg['params'])
			 ->prep($arg['action']);
	
		$this->dispatcher->setTaskName($arg['task']);
		$this->dispatcher->setActionName($arg['action']);
		$this->dispatcher->setParams($arg['params']);

		$this->dispatcher->setDI($this->di);

		return $this->dispatcher->dispatch();
	}

	/**
	 * Adds a command to the library
	 *
	 * @return Application
	 * @author Dan Cox
	 */
	public function add($command)
	{
		$tasks = $this->prepper
					  ->load(get_class($command))
					  ->describe();

		$this->library->add(['task' => $tasks, 'class' => $command]);

		return $this;
	}

	/**
	 * Find a command by name
	 *
	 * @return Object
	 * @author Dan Cox
	 */
	public function find($name)
	{
		return $this->library->find($name);
	}


	/**
	 * Format the arguments into a useable state
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function formatArgs($args)
	{
		// The first argument is always the file
		unset($args[0]);

		$command = explode(':', $args[1]);
		unset($args[1]);

		$action = (isset($command[1]) ? $command[1] : 'main');
		$cmd = $this->library->find($command[0].':'.$action);
		$task = get_class($cmd);

		return Array(
			'task'		=> $task,
			'action' 	=> $action,
			'params'	=> $args
		);
	}

	/**
	 * Sets the suffix for task classes
	 *
	 * @return Application
	 * @author Dan Cox
	 */
	public function setTaskSuffix($suffix = '')
	{
		$this->dispatcher->setTaskSuffix($suffix);
		return $this;	
	}

	/**
	 * Sets the action suffix
	 *
	 * @return Application
	 * @author Dan Cox
	 */
	public function setActionSuffix($suffix = '')
	{
		$this->dispatcher->setActionSuffix($suffix);
		return $this;
	}

	/**
	 * Returns the DI
	 *
	 * @return Object
	 * @author Dan Cox
	 */
	public function getDI()
	{
		return $this->di;
	}

	/**
	 * Gets the value of the name
	 *
	 * @return String
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the value of name
	 *
	 * @param name $name The name of the CLI
	 *
	 * @return Application
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Gets the value of version
	 *
	 * @return version
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * Sets the value of version
	 *
	 * @param version $version The cli version
	 *
	 * @return Application
	 */
	public function setVersion($version)
	{
		$this->version = $version;
		return $this;
	}

} // END class Application 
