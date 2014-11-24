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
	}
	

} // END class CommandTesterTest extends \PHPUnit_Framework_TestCase
