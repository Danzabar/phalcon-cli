<?php namespace Danzabar\CLI\Tasks;

use Danzabar\CLI\Input\InputArgument,
	Danzabar\CLI\Input\InputOption;


/**
 * Task prepper class loads a reflection of a task and its expected vars and setup
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class TaskPrepper
{
	/**
	 * The reflection instance
	 *
	 * @var Object
	 */
	protected $reflection;

	/**
	 * The dependency injector
	 *
	 * @var Object
	 */
	protected $di;
	
	/**
	 * An Array of arguments given
	 *
	 * @var Array
	 */
	protected $arguments;

	/**
	 * An Array of options given
	 *
	 * @var Array
	 */
	protected $options;

	/**
	 * Create class vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($className, $di)
	{
		// Create reflection
		$this->reflection = new \ReflectionClass($className);

		// DI
		$this->di = $di;

		// Add input class to the di
		$this->di->setShared('arguments', new InputArgument);
	   	$this->di->setShared('option', new InputOption);
	}

	/**
	 * Looks for defined arguments and options and validates them
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function prep($action = NULL)
	{		
		if($this->reflection->hasMethod('setup'))
		{
			$method = $this->reflection->getMethod('setup');	
			$task = $this->reflection->newInstance();
			
			$method->invokeArgs($task, Array('action' => $action));
		}
	}


} // END class TaskPrepper extends \ReflectionClass
