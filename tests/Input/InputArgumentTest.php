<?php

use Danzabar\CLI\Input\InputArgument;

/**
 * Test case for the Input Argument class
 *
 * @package CLI
 * @subpackage Tests\Input
 * @author Dan Cox
 */
class InputArgumentTest extends \PHPUnit_Framework_TestCase
{
	
	/**
	 * Instance of the input argument class
	 *
	 * @var Object
	 */
	protected $inputArgument;

	/**
	 * Set up the test vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->inputArgument = new InputArgument;
	}

	/**
	 * Test adding and getting expectations
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_addGetExpectations()
	{
		$this->inputArgument->addExpected('name', InputArgument::Required);

		$expectations = $this->inputArgument->getExpected();

		$this->assertTrue(array_key_exists('name', $expectations));
		$this->assertEquals(InputArgument::Required, $expectations['name']);
	}


} // END class InputArgumentTest extends \PHPUnit_Framework_TestCase
