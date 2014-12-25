<?php namespace Danzabar\CLI;

use Danzabar\CLI\Application,
	Phalcon\DI\FactoryDefault\CLI,
	Danzabar\CLI\Input\Input;

/**
 * The command tester class provides a base to test commands
 *
 * @package CLI
 * @subpackage Commands
 * @author Dan Cox
 */
class CommandTester
{
	
	/**
	 * An Instance of the console application
	 *
	 * @var Object
	 */
	protected $application;

	/**
	 * The task:action command string
	 *
	 * @var string
	 */
	protected $command;

	/**
	 * The command params
	 *
	 * @var Array
	 */
	protected $params;

	/**
	 * The raw output
	 *
	 * @var Mixed
	 */
	protected $output;

	/**
	 * Load the application
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($application = Null)
	{
		$this->application = (!is_null($application) ? $application : new Application );

		if(is_null($application))
		{
			// Load a DI into the app
			$di = new CLI;
			$this->application->setDI($di);
		}
	} 

	/**
	 * Sets an input for questions and confirmation
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setInput($str)
	{
		$di = $this->application->getDI();
		
		$input = new Input('php://memory');
		$input->mock($str);

		$di->setShared('input', $input);
	}

	/**
	 * Execute the command
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function execute($command = NULL, $params = Array())
	{
		if(!is_null($command))
		{
			$this->command = $command;
		}

		$args = Array('cli', $this->command);
	
		foreach($params as $param)
		{
			$args[] = $param;
		}

		ob_start();

			$this->application->start($args);

			$this->output = ob_get_contents();

		ob_end_clean();
	}

	/**
	 * Returns the output
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function getOutput()
	{
		return $this->output;
	}

	/**
	 * Sets the task:action command
	 *
	 * @return $this
	 * @author Dan Cox
	 */
	public function setCommand($command)
	{
		$this->command = $command;

		return $this;
	}

	/**
	 * Returns the current command
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function getCommand()
	{
		return $this->command;
	}

	/**
	 * Returns the application class
	 *
	 * @return Object
	 * @author Dan Cox
	 */
	public function getApplication()
	{
		return $this->application;
	}


} // END class CommandTester
