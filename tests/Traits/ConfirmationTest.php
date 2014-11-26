<?php

use Danzabar\CLI\CommandTester;

/**
 * Test case for the Confirmation Trait
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class ConfirmationTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Instance of the command tester
	 *
	 * @var Object
	 */
	protected $CT;

	/**
	 * Setup the command Tester
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->CT = new CommandTester();
	}

	/**
	 * Test the confirmation action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_confirmationAction()
	{
		$this->CT->setInput("Y\n");
		$this->CT->execute('Fake:confirmation');

		$this->assertContains('Thanks for confirming', $this->CT->getOutput());
	}

	/**
	 * Same as above, but we say no. 
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_confirmationDecline()
	{
		$this->CT->setInput("N\n");
		$this->CT->execute('Fake:confirmation');

		$this->assertContains("Action cancelled", $this->CT->getOutput());
	}

	/**
	 * With explicit option switched off, any answer that isnt Y should be considered N
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_implicitAction()
	{
		$this->CT->setInput("P\n");
		$this->CT->execute('Fake:confirmation');

		$this->assertContains("Action cancelled", $this->CT->getOutput());
	}

	/**
	 * Set to explicit and given a response it does not expect
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_confirmationError()
	{
		$this->CT->setInput("P\n");
		$this->CT->execute('Fake:explicitConfirm');

		$this->assertContains("Unexpected confirmation", $this->CT->getOutput());
	}

	/**
	 * Set a custom confirmation error
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_customConfirmationError()
	{
		$this->CT->setInput("P\n");
		$this->CT->execute('Fake:explicitConfirm', Array('Invalid'));

		$this->assertContains("Invalid", $this->CT->getOutput());
	}



} // END class ConfirmationTest extends \PHPUnit_Framework_TestCase
