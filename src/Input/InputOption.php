<?php namespace Danzabar\CLI\Input;

use Danzabar\CLI\Tools\ParamBag,
	Danzabar\CLI\Input\Traits\ExpectationTrait,
	Danzabar\CLI\Input\Traits\ValidationTrait;

/**
 * The input option contains cli options eg. --option
 *
 * @package CLI
 * @subpackage Input
 * @author Dan Cox
 */
class InputOption extends ParamBag
{
	use ExpectationTrait, ValidationTrait;

	/**
	 * Constants for validation
	 *
	 */
	const Required	= 'required';
	const Optional	= 'optional';

	/**
	 * An array of expected options
	 *
	 * @var Array
	 */
	protected static $expected = Array();

	/**
	 * An array of option positions
	 *
	 * @var Array
	 */
	protected static $varPosition = Array();

	/**
	 * For validation types
	 *
	 * @var string
	 */
	protected $v_type = 'option';
	
} // END class InputOption extends ParamBag
