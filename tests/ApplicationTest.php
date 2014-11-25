<?php

use Danzabar\CLI\Application,
	Phalcon\DI\FactoryDefault\CLI,
	Phalcon\Loader,
	\Mockery as m;

/**
 * Test case for the application class
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Mockery of the console object
	 *
	 * @var Object
	 */
	protected $console;

	/**
	 * Mockery of the dependancy injection class
	 *
	 * @var Object
	 */
	protected $di;

	/**
	 * Instance of the application class
	 *
	 * @var Object
	 */
	protected $application;


	/**
	 * Set up the test environment
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->console = m::mock('Console');
		$this->di = m::mock('CLI');

		$this->application = new Application($this->console);
	}

	/**
	 * Test that everything is set as it should be
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_vars()
	{
		$this->console->shouldReceive('setDI')->once();
		$this->di->shouldReceive('set')->once();

		$this->application->setDI($this->di);		

		$this->assertInstanceOf('CLI', $this->application->getDI());
		$this->assertInstanceOf('Console', $this->application->getConsole());
	}

	/**
	 * Test the args come out in right way when we provide all the info it needs
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_sortArgsWithAll()
	{
		$test = $this->application->formatArgs(Array(
			'cli',
			'command:action',
			'param1',
			'param2'
		));

		$this->assertEquals(
			Array('task' => 'command', 'action' => 'action', 'params' => Array('param1', 'param2')),
			$test
		);
	}

	/**
	 * Test similiar to above but without providing an action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_sortArgsWithoutAction()
	{
		$test = $this->application->formatArgs(Array(
			'cli',
			'command',
			'param1'
		));

		$this->assertEquals(
			Array('task' => 'command', 'action' => 'main', 'params' => Array('param1')),
			$test
		);
	}

	/**
	 * Test firing a command
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_fireCommand()
	{
		$di = new CLI; 
		
		$app = new Application;
		$app->setDI($di);

		$di->setShared('console', $app);
	
		ob_start();
			
			$app->start(Array('cli', 'Fake'));
			
			$content = ob_get_contents();

		ob_end_clean();

		$this->assertContains('main action', $content);
	}

	/**
	 * Test that the input and output are set properly
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_SetOutputInput()
	{
		$di = new CLI;
		$app = new Application;
		$app->setDI($di);

		$di->setShared('console', $app);
		
		$command = $app->start(Array('cli', 'Fake:output'));
		$this->assertInstanceOf('\Danzabar\CLI\Output\Output', $command->getOutput());
		$this->assertInstanceOf('\Danzabar\CLI\Input\Input', $command->getInput());	
	}
	

} // END class ApplicationTest extends \PHPUnit_Framework_TestCase
