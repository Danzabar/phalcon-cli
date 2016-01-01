<?php

use Danzabar\CLI\Input\Exceptions\IncorrectValidationMethodException;

/**
 * Test case for the incorrect validation method exception class
 *
 * @package CLI
 * @subpackage Tests\Input
 * @author Dan Cox
 */
class IncorrectValidationMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test firing the exception
     *
     * @return void
     * @author Dan Cox
     */
    public function test_fireException()
    {
        try {

            throw new IncorrectValidationMethodException("numeric");
        } catch (\Exception $e) {

            $this->assertEquals("numeric", $e->getMethod());
        }
    }
} // END class IncorrectValidationMethodTest extends \PHPUnit_Framework_TestCase
