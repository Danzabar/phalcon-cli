<?php

namespace Danzabar\CLI\Input\Exceptions;

/**
 * The exception fired when an incorrect validation method is given.
 *
 * @package CLI
 * @subpackage Tests\Exceptions
 * @author Dan Cox
 */
class IncorrectValidationMethodException extends \Exception
{
    /**
     * The attempted method
     *
     * @var string
     */
    protected $method;

    /**
     * Fire the exception
     *
     * @return void
     * @author Dan Cox
     */
    public function __construct($method, $code = 0, \Exception $previous = null)
    {
        $this->method = $method;

        parent::__construct("The $method validation method could not be found", $code, $previous);
    }

    /**
     * Returns the method
     *
     * @return String
     * @author Dan Cox
     */
    public function getMethod()
    {
        return $this->method;
    }
} // END class IncorrectValidationMethodException extends \Exception
