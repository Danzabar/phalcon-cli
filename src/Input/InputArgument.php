<?php

namespace Danzabar\CLI\Input;

use Danzabar\CLI\Tools\ParamBag;
use Danzabar\CLI\Input\Traits\ExpectationTrait;
use Danzabar\CLI\Input\Traits\ValidationTrait;

/**
 * The input argument class is a param bag that contains arguments from the user
 *
 * @package CLI
 * @subpackage Input
 * @author Dan Cox
 */
class InputArgument extends ParamBag
{
    use ExpectationTrait, ValidationTrait;

    /**
     * Class constants for validation
     *
     */
    const REQUIRED      = 'required';
    const OPTIONAL      = 'optional';
    const ALPHA         = 'alpha';
    const INT           = 'int';

    /**
     * An array of expected arguments
     *
     * @var Array
     */
    protected static $expected = array();

    /**
     * An array of argument positions
     *
     * @var string
     */
    protected static $varPosition = array();

    /**
     * For validation types
     *
     * @var string
     */
    protected $v_type = 'argument';
} // END class InputArgument
