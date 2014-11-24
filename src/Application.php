<?php namespace Danzabar\CLI;

use Phalcon\CLI\Console,
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
	 * undocumented function
	 *
	 * @return Application
	 * @author Dan Cox
	 */
	public function setDI($di)
	{
		$this->di = $di;
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
	
		$this->console->handle($arguments);		
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

} // END class Application extends 
