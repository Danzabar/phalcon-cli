<?php

use Danzabar\CLI\Application,
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
		$this->application = new Application();
		$this->application
					->setName('Test CLI')
					->setVersion('1.0');
	}

	/**
	 * Check that the name and version is correct
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_nameAndVersion()
	{
		$this->assertEquals('Test CLI', $this->application->getName());
		$this->assertEquals('1.0', $this->application->getVersion());
	}

	/**
	 * Test that everything is set as it should be
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_vars()
	{
		$this->assertInstanceOf('Phalcon\DI', $this->application->getDI());
	}

	/**
	 * Test firing a command
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_fireCommand()
	{
		$app = new Application;
		$app->add(new FakeTask);
	
		ob_start();
			
			$app->start(Array('cli', 'fake'));
			
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
		$app = new Application;
		$app->add(new FakeTask);
		$app->start(Array('cli', 'fake:output'));

		#$this->assertInstanceOf('\Danzabar\CLI\Output\Output', $app->getOutput());
		#$this->assertInstanceOf('\Danzabar\CLI\Input\Input', $app->getInput());	
	}

	/**
	 * Test adding a fetching commands from the library
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_interactionsWithLibrary()
	{
		$app = new Application;
		$app->add(new FakeTask);
		
		$command = $app->find('fake:output');

		$this->assertInstanceOf('FakeTask', $command);
	}
	

} // END class ApplicationTest extends \PHPUnit_Framework_TestCase
