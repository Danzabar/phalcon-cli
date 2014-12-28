<?php

use Danzabar\CLI\Input\InputOption;

/**
 * Test case for the input option class
 *
 * @package CLI
 * @subpackage Tests\Input
 * @author Dan Cox
 */
class InputOptionTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * The input option instance
	 *
	 * @var Object
	 */
	protected $inputOption;

	/**
	 * Set up test vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->inputOption = new InputOption;
	}

	/**
	 * Test the expectation trait
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_addGetExpectation()
	{
		$this->inputOption->addExpected('test');
		$expectations = $this->inputOption->getExpected();

		$this->assertTrue(array_key_exists('test', $expectations));
		$this->assertEquals(InputOption::Optional, $expectations['test']);
	}

	
} // END class InputOptionTest extends \PHPUnit_Framework_TestCase
