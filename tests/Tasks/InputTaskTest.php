<?php

use Danzabar\CLI\CommandTester;

/**
 * Test case for the input classes
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class InputTaskTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Instance of the command tester
	 *
	 * @var Object
	 */
	protected $CT;

	/**
	 * Set up the command tester
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->CT = new CommandTester();
	}

	/**
	 * Test that the options work
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_optionIsSet()
	{
		$this->CT->execute('Input', Array('--verbose'));

		$this->assertContains('verbose mode activated', $this->CT->getOutput());
	}

	/**
	 * Test the output when the option is not set
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_optionIsNotSet()
	{
		$this->CT->execute('Input');

		$this->assertContains('...', $this->CT->getOutput());
	}



} // END class InputTaskTest extends \PHPUnit_Framework_TestCase
