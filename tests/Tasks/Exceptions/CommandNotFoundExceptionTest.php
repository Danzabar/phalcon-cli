<?php

use Danzabar\CLI\Tasks\Exceptions\CommandNotFoundException;

/**
 * Test case for the command not found exception
 *
 * @package CLI
 * @subpackage Tests\Tasks
 * @author Dan Cox
 */
class CommandNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test fire exception
     *
     * @return void
     * @author Dan Cox
     */
    public function test_fireException()
    {
        try {
            throw new CommandNotFoundException('task:action');
        } catch (\Exception $e) {
            $this->assertEquals('task:action', $e->getCommand());
        }
    }
} // END class CommandNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
