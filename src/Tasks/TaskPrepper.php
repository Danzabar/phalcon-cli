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
		$this->di->setShared('argument', new InputArgument);
	   	$this->di->setShared('option', new InputOption);

		// Clear the params
		$this->di->get('argument')->clearExpected();
		$this->di->get('option')->clearExpected();
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
		
		$this->sortParams();
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
			}
		}

		foreach($expectedOptions as $pos => $key)
		{
			if(array_key_exists($pos, $this->options))
			{
				$options[$key] = $this->di->get('option')->validate($key, $this->options[$pos]);
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
