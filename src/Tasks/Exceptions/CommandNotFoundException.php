<?php namespace Danzabar\CLI\Tasks\Exceptions;


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
	 * @author Dan Cox
	 */
	public function __construct($command, $code = 0, \Exception $previous = NULL)
	{
		$this->command = $command;
		parent::__construct("The command was not found $command", $code, $previous);
	}

	/**
	 * Returns the command
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function getCommand()
	{
		return $this->command;
	}

} // END class CommandNotFoundException extends \Exception
