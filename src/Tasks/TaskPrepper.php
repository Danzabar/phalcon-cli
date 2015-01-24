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
	 * The Class name
	 *
	 * @var string
	 */
	protected $className;

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
	public function __construct($di)
	{
		// DI
		$this->di = $di;

		// Add input class to the di
		$this->di->setShared('argument', new InputArgument);
	   	$this->di->setShared('option', new InputOption);

		// Clear the params
		$this->di->get('argument')->clearExpected();
		$this->di->get('option')->clearExpected();
	}

	/**
	 * Loads the command and creates a reflection entity for it.
	 *
	 * @return TaskPrepper
	 * @author Dan Cox
	 */
	public function load($className)
	{
		// Create reflection
		$this->reflection = new \ReflectionClass($className);

		// Save the class name
		$this->className = $className;

		return $this;
	}

	/**
	 * Describes a task for the library
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function describe()
	{
		$methods = Array();

		foreach($this->reflection->getMethods() as $method)
		{
			$methods[] = $method->getName();
		}

		$name = $this->className;

		if($this->reflection->hasProperty('name'))
		{
			$prop = $this->reflection->getProperty('name');
			$prop->setAccessible(TRUE);
			$name = $prop->getValue($this->reflection->newInstance());
		}

		return Array('name' => $name, 'class' => $this->className, 'actions'  => $methods);
	}

	/**
	 * Looks for defined arguments and options and validates them
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function prep($action = NULL)
	{		
		$method = $this->getSetupMethod($action);

		if(!is_null($method))
		{
			$method->invokeArgs($this->reflection->newInstance(), Array('action' => $action));
		}

		$this->sortParams();
	}

	/**
	 * Gets the setup method used by the task
	 *
	 * @return ReflectionMethod|NULL
	 * @author Dan Cox
	 */
	public function getSetupMethod($action)
	{	
		if($this->reflection->hasMethod('setup'.ucwords($action)))
		{	
			return $this->reflection->getMethod('setup'.ucwords($action));

		} elseif($this->reflection->hasMethod('setup'))
		{
			return $this->reflection->getMethod('setup');
		}

		return NULL;
	}

	/**
	 * This function takes arguments and options and sorts them by order relating 
	 * them to expected arguments in order to give them a key value
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function sortParams()
	{
		$arguments = Array();
		$options = Array();

		$expectedArguments = $this->di->get('argument')->getExpectedOrder();
		$expectedOptions = $this->di->get('option')->getExpectedOrder();
			
		foreach($expectedArguments as $pos => $key)
		{
			if(array_key_exists($pos, $this->arguments))
			{
				$arguments[$key] = $this->di->get('argument')->validate($key, $this->arguments[$pos]);
			} else
			{
				$this->di->get('argument')->validate($key, NULL);
			}
		}

		foreach($expectedOptions as $pos => $key)
		{
			if(array_key_exists($pos, $this->options))
			{
				$options[$key] = $this->di->get('option')->validate($key, $this->options[$pos]);
			} else
			{
				$this->di->get('option')->validate($key, NULL);
			}
		}		

		// Load these
		$this->di->get('argument')->load($arguments);
		$this->di->get('option')->load($options);
	}

	/**
	 * Loads params and splits them into arguments and options
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function loadParams(Array $params)
	{
		$this->arguments = Array();
		$this->options = Array();

		foreach($params as $param)
		{
			if(strpos($param, '--') !== false)
			{
				$this->options[] = str_replace('--', '', $param);
			} else
			{
				$this->arguments[] = $param;
			}
		}

		return $this;
	}


} // END class TaskPrepper extends \ReflectionClass
