<?php

use Danzabar\CLI\Application,
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
		$this->di = m::mock('Phalcon\DI\FactoryDefault\CLI');

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
		
		$this->application->setDI($this->di);		

		$this->assertInstanceOf('Phalcon\DI\FactoryDefault\CLI', $this->application->getDI());
	}
	

} // END class ApplicationTest extends \PHPUnit_Framework_TestCase
