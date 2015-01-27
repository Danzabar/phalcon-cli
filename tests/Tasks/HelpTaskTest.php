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

		// Setup some fake app details
		$app = $this->CT->getApplication();
		$app->setName('Test CLI');
		$app->setVersion('1.0.0');

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

		// Application Detail Assertions
		$this->assertContains('Test CLI', $this->CT->getOutput());
		$this->assertContains('version 1.0.0', $this->CT->getOutput());

		// Random detail assertions
		$this->assertContains('Help', $this->CT->getOutput());
		$this->assertContains('Fake', $this->CT->getOutput());
		$this->assertContains('confirmation', $this->CT->getOutput());

		// Instruction Assertions
		$this->assertContains('php [file] [command] [arguments] [options]', $this->CT->getOutput());

		// Example commands Assertions
		$this->assertContains('php [file] fake [params]', $this->CT->getOutput());
		$this->assertContains('php [file] fake:askMe [params]', $this->CT->getOutput());
	}

} // END class HelpTaskTest extends \PHPUnit_Framework_TestCase
