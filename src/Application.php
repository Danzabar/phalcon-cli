<?php namespace Danzabar\CLI;

use Phalcon\CLI\Console,
	Danzabar\CLI\Output\Output,
	Danzabar\CLI\Input\Input,
	Danzabar\CLI\Tasks\TaskPrepper,
	Phalcon\DI\FactoryDefault\CLI;


/**
 * The Application class for CLI commands
 *
 * @package CLI
 * @subpackage Application
 * @author Dan Cox
 */
class Application extends Console
{
	/**
	 * The Dependancy object
	 *
	 * @var Object
	 */
	protected $di;

	/**
	 * The raw set of arguments from the CLI
	 *
	 * @var Array
	 */
	protected $arguments;

	/**
	 * The instance of the console
	 *
	 * @var Object
	 */
	protected $console;

	/**
	 * The task Prepper instance
	 *
	 * @var Object
	 */
	protected $prepper;

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
	public function __construct($console = NULL)
	{
		$this->console = (!is_null($console) ? $console : new Console);
	}

	/**
	 * Set the dependency injector
	 *
	 * @return Application
	 * @author Dan Cox
	 */
	public function setDI($di)
	{
		$this->di = $di;

		// Add the output and input streams to the DI
		$this->di->setShared('output', new Output);
		$this->di->setShared('input', new Input);

		$this->console->setDI($di);

		return $this;
	}

	/**
	 * Start the app
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function start($args = Array())
	{
		$arguments = $this->formatArgs($args);

		/**
		 * Arguments and Options
		 *
		 */
		$this->prepper = new TaskPrepper($arguments['task']."Task", $this->di);
		$this->prepper
			 ->loadParams($arguments['params'])
			 ->prep($arguments['action']."Action");

	
		return $this->console->handle($arguments);		
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

		// The second argument will be the task:action
		$command = explode(':', $args[1]);
		unset($args[1]);
		
		// Anything that remains are params
		return Array(
			'task'		=> $command[0],
			'action'	=> (isset($command[1]) ? $command[1] : 'main'),
			'params'	=> array_values($args)
		);		
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
	 * Returns the console object
	 *
	 * @return Object
	 * @author Dan Cox
	 */
	public function getConsole()
	{
		return $this->console;
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

} // END class Application extends 
