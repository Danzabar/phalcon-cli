<?php

namespace Danzabar\CLI\Tasks\Exceptions;

/**
 * Exception class for when a command isnt found
 *
 * @package CLI
 * @subpackage Tasks\Exceptions
 * @author Dan Cox
 */
class CommandNotFoundException extends \Exception
{

    /**
     * The command name
     *
     * @var string
     */
    protected $command;


    /**
     * Fire command
     *
     * @return void
     */
    public function __construct($command, $code = 0, \Exception $previous = null)
    {
        $this->command = $command;
        parent::__construct("The command was not found $command", $code, $previous);
    }

    /**
     * Returns the command
     *
     * @return String
     */
    public function getCommand()
    {
        return $this->command;
    }
} // END class CommandNotFoundException extends \Exception
