<?php

use Danzabar\CLI\Tasks\Exceptions\RegisteredHelperClassNotFoundException;

/**
 * Test case for the registered helper class not found exception
 *
 * @package CLI
 * @subpackage Tests\Tasks
 * @author Dan Cox
 */
class RegisteredHelperClassNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Fire the exception
     *
     * @return void
     * @author Dan Cox
     */
    public function test_fireException()
    {
        try {

            throw new RegisteredHelperClassNotFoundException('TestClass');

        } catch (\Exception $e) {

            $this->assertEquals('TestClass', $e->getClass());
        }
    }
} // END class RegisteredHelperClassNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
