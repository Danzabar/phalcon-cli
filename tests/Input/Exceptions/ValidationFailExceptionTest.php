<?php

use Danzabar\CLI\Input\Exceptions\ValidationFailException;

/**
 * Test case for the validation fail exception class
 *
 * @package CLI
 * @subpackage Tests\Input
 * @author Dan Cox
 */
class ValidationFailExceptionTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * fire the exception
     *
     * @return void
     * @author Dan Cox
     */
    public function test_fire()
    {
        try {
        
            throw new ValidationFailException('eheud', 'Email');

        } catch (\Exception $e) {
            
            $this->assertEquals('eheud', $e->getValue());
            $this->assertEquals('Email', $e->getMethod());
        }
    }
} // END class ValidationFailExceptionTest extends \PHPUnit_Framework_TestCase
