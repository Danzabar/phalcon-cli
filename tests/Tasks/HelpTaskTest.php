<?php 

use Danzabar\CLI\CommandTester;

/**
 * Test case for the help task
 *
 * @package CLI
 * @subpackage Tests/Tasks
 * @author Dan Cox
 */
class HelpTaskTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Command tester instance
	 *
	 * @var Object
	 */
	protected $CT;

	/**
	 * Set up test vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->CT = new CommandTester;

		// Add some tasks to play with
		$this->CT->add(new FakeTask);
	}

	/**
	 * Test that the application calls the help task when no other task is specified.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_helpTestWhenNoOtherIsSpecified()
	{
		// Execute a blank request
		$this->CT->execute();

		$this->assertInstanceOf('Danzabar\CLI\Tasks\Utility\Help', $this->CT->getTask());
	}

	/**
	 * Test the help list format is correct
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_helpFormat()
	{
		$this->CT->execute();

		$this->assertContains('Help', $this->CT->getOutput());
		$this->assertContains('Fake', $this->CT->getOutput());
		$this->assertContains('confirmation', $this->CT->getOutput());
	}

} // END class HelpTaskTest extends \PHPUnit_Framework_TestCase
