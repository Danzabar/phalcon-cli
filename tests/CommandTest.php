<?php

use Danzabar\CLI\Command;

/**
 * The test case for the Command class
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class CommandTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Test the help function output
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_helpFunction()
	{
		$command = new FakeTask();

		ob_start();
		
			$command->helpTask();

			$content = ob_get_contents();

		ob_end_clean();

		$this->assertContains('Test command', $content);
		$this->assertContains('The test command provides no use,', $content);
	}


} // END class CommandTest extends \PHPUnit_Framework_TestCase
