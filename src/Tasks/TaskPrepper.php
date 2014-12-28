<?php namespace Danzabar\CLI\Tasks;

/**
 * Task prepper class loads a reflection of a task and its expected vars and setup
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class TaskPrepper extends \ReflectionClass
{
	/**
	 * Constants for expectations
	 *
	 */
	const REQUIRED = 'required';
	const OPTIONAL = 'optional';
	const VALUEOPTIONAL = 'value-optional';

	/**
	 * The reflection instance
	 *
	 * @var Object
	 */
	protected $reflection;

	/**
	 * An array of arguments ready for the InputArgument
	 *
	 * @var array
	 */
	protected $arguments;

	/**
	 * An array of options ready for the InputOption
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * An array of expected arguments with their keys
	 *
	 * @var Array
	 */
	protected $expectedArguments;

	/**
	 * An array of expected options with their keys
	 *
	 * @var Array
	 */
	protected $expectedOptions;

	/**
	 * Create class vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($className)
	{
		
	}


} // END class TaskPrepper extends \ReflectionClass
