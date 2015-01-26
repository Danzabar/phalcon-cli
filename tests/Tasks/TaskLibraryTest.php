<?php

use Danzabar\CLI\Tasks\TaskLibrary;

/**
 * Test case for the task library
 *
 * @package CLI
 * @subpackage Tests\Tasks
 * @author Dan Cox
 */
class TaskLibraryTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Instance of the library
	 *
	 * @var Object
	 */
	protected $library;
	
	/**
	 * Set up test vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->library = new TaskLibrary();
	}

	/**
	 * Test adding and getting back class
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_addGet()
	{	
		$arr = Array('task' => Array(
			'name'	=> 'Command',
			'description' => '',
			'actions' => ['main', 'run'],
		), 'class' => 'TEST');

		$this->library->add($arr);

		// Now find this by its command name
		$val = $this->library->find('Command:run');

		$this->assertEquals('TEST', $val);
	}

} // END class TaskLibraryTest extends \PHPUnit_Framework_TestCase
