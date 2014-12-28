<?php namespace Danzabar\CLI\Input;

use Danzabar\CLI\Tools\ParamBag,
	Danzabar\CLI\Input\Traits\ExpectationTrait;


/**
 * The input argument class is a param bag that contains arguments from the user
 *
 * @package CLI
 * @subpackage Input
 * @author Dan Cox
 */
class InputArgument extends ParamBag
{
	use ExpectationTrait;

	/**
	 * Class constants for validation
	 *
	 */
	const Required 		= 'required';
	const Optional 		= 'optional';

} // END class InputArgument
