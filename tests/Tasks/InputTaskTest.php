<?php

use Danzabar\CLI\CommandTester,
	Danzabar\CLI\Application,
	Phalcon\DI\FactoryDefault\CLI;

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

	/**
	 * Test the required argument
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_requiredArgument()
	{
		$this->CT->execute('Input:required', Array('email' => 'danzabar@gmail.com'));

		$this->assertContains('danzabar@gmail.com', $this->CT->getOutput());
	}

	/**
	 * Test that the exception action throws an exception
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_throwInvalidValidationException()
	{
		$this->setExpectedException('Danzabar\CLI\Input\Exceptions\IncorrectValidationMethodException');

		$this->CT->execute('Input:exception');
	}

	/**
	 * Test exception fires on missing argument
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_missingRequiredArgument()
	{
		$this->setExpectedException('Danzabar\CLI\Input\Exceptions\RequiredValueMissingException');
		
		$this->CT->execute('Input:required');	
	}

	/**
	 * Test the validation action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_validationActionCorrectValue()
	{
		$this->CT->execute('Input:validation', Array('value' => 'abcd'));
		
		$this->assertContains('abcd', $this->CT->getOutput());	
	}

	/**
	 * Test the error reporting from the validate_alpha method
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_validationActionException()
	{
		$this->setExpectedException('Danzabar\CLI\Input\Exceptions\ValidationFailException');

		$this->CT->execute('Input:validation', Array('value' => 'a12v'));
	}



} // END class InputTaskTest extends \PHPUnit_Framework_TestCase
