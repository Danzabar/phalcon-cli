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
        $this->inputArgument->addExpected('name', InputArgument::REQUIRED);

        $expectations = $this->inputArgument->getExpected();

        $this->assertTrue(array_key_exists('name', $expectations));
        $this->assertEquals(InputArgument::REQUIRED, $expectations['name']);
    }

    /**
     * Test that an exception is thrown when you pass an invalid rule
     *
     * @return void
     * @author Dan Cox
     */
    public function test_exceptionOnInvalidRequirement()
    {
        $this->setExpectedException('Danzabar\CLI\Input\Exceptions\IncorrectValidationMethodException');

        $this->inputArgument->addExpected('name', 'fakerule');
        $this->inputArgument->validate('name', '');
    }
} // END class InputArgumentTest extends \PHPUnit_Framework_TestCase
