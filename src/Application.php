<?php namespace Danzabar\CLI;

use Phalcon\CLI\Dispatcher,
	Danzabar\CLI\Output\Output,
	Danzabar\CLI\Input\Input,
	Danzabar\CLI\Tasks\TaskPrepper,
	Danzabar\CLI\Tasks\TaskLibrary,
	Danzabar\CLI\Tasks\Helpers,
	Danzabar\CLI\Tasks\Utility\Help,
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
	 * Instance of the Helpers class
	 *
	 * @var Object
	 */
	protected $helpers;

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

		$this->setUpDispatcherDefaults();

		// Add the output and input streams to the DI
		$this->di->setShared('output', new Output);
		$this->di->setShared('input', new Input);
		$this->di->setShared('console', $this);
		
		$this->prepper = new TaskPrepper($this->di);
		$this->helpers = new Helpers($this->di);
		$this->registerDefaultHelpers();

		$this->di->setShared('helpers', $this->helpers);

		$this->addDefaultCommands();
	}

	/**
	 * Adds the default commands like Help and List
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function addDefaultCommands()
	{
		$this->add(new Help);
	}

	/**
	 * Sets up the default settings for the dispatcher
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUpDispatcherDefaults()
	{
		// Set the defaults for the dispatcher
		$this->dispatcher->setDefaultTask('Danzabar\CLI\Tasks\Utility\Help');
		$this->dispatcher->setDefaultAction('main');

		// Set no suffixes
		$this->dispatcher->setTaskSuffix('');
		$this->dispatcher->setActionSuffix('');
	}

	/**
	 * Registers the question, confirmation and table helpers
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function registerDefaultHelpers()
	{
		$this->helpers->registerHelper('question', 'Danzabar\CLI\Tasks\Helpers\Question');
		$this->helpers->registerHelper('confirm', 'Danzabar\CLI\Tasks\Helpers\Confirmation');
		$this->helpers->registerHelper('table', 'Danzabar\CLI\Tasks\Helpers\Table');
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
		if(!empty($arg))
		{
			$this->prepper
				 ->load($arg['task'])
				 ->loadParams($arg['params'])
				 ->prep($arg['action']);
	
			$this->dispatcher->setTaskName($arg['task']);
			$this->dispatcher->setActionName($arg['action']);
			$this->dispatcher->setParams($arg['params']);
		}

		$this->di->setShared('library', $this->library);
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

		try {
			
			$action = (isset($command[1]) ? $command[1] : 'main');
			$cmd = $this->library->find($command[0].':'.$action);
			$task = get_class($cmd);

			return Array(
				'task'		=> $task,
				'action' 	=> $action,
				'params'	=> $args
			);

		} catch(\Exception $e) {
		
			return Array();
		}
	}

	/**
	 * Returns the helpers object
	 *
	 * @return Object
	 * @author Dan Cox
	 */
	public function helpers()
	{
		return $this->helpers;
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
