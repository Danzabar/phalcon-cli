<?php

use Danzabar\CLI\CommandTester;

/**
 * The test case to check that the Command tester is fully operational
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class CommandTesterTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Test basic usage of the command tester
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_basic()
	{
		$tester = new CommandTester;

		$tester->execute('Utility:main');
		
		$this->assertContains('The main action', $tester->getOutput());
		$this->assertInstanceOf('\Danzabar\CLI\Application', $tester->getApplication());
	}

	/**
	 * Test the command setter and getter
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_CommandSetGet()
	{
		$tester = new CommandTester;

		$tester->setCommand('Utility:main');
		$command1 = $tester->getCommand();

		$tester->execute('Fake:main');
		$command2 = $tester->getCommand();

		$this->assertEquals('Utility:main', $command1);
		$this->assertEquals('Fake:main', $command2);
	}
	

} // END class CommandTesterTest extends \PHPUnit_Framework_TestCase
