<?php namespace Danzabar\CLI\Input;

use Danzabar\CLI\Tools\ParamBag,
	Danzabar\CLI\Input\Traits\ExpectationTrait;

/**
 * The input option contains cli options eg. --option
 *
 * @package CLI
 * @subpackage Input
 * @author Dan Cox
 */
class InputOption extends ParamBag
{
	use ExpectationTrait;

	/**
	 * Constants for validation
	 *
	 */
	const Required	= 'required';
	const Optional	= 'optional';
	
} // END class InputOption extends ParamBag
