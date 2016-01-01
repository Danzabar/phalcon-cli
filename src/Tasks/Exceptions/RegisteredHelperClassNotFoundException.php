<?php namespace Danzabar\CLI\Tasks\Exceptions;

/**
 * The exception class for when a registered helper is called but not defined
 *
 * @package CLI
 * @subpackage Tasks\Exceptions
 * @author Dan Cox
 */
class RegisteredHelperClassNotFoundException extends \Exception
{
    /**
     * The class name attempted
     *
     * @var string
     */
    protected $className;

    /**
     * Fire exception
     *
     * @return void
     * @author Dan Cox
     */
    public function __construct($className, $code = 0, \Exception $previous = null)
    {
        $this->className = $className;

        parent::__construct("Attempted to load missing helper class: $className", $code, $previous);
    }

    /**
     * Returns the class name
     *
     * @return String
     * @author Dan Cox
     */
    public function getClass()
    {
        return $this->className;
    }
} // END class RegisteredHelperClassNotFoundExceptions extends \Exception
