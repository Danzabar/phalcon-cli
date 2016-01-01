<?php

namespace Danzabar\CLI\Input;

use Danzabar\CLI\Tools\ParamBag;
use Danzabar\CLI\Input\Traits\ExpectationTrait;
use Danzabar\CLI\Input\Traits\ValidationTrait;

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
    const REQUIRED          = 'required';
    const OPTIONAL          = 'optional';
    const VALUEREQUIRED     = 'valueRequired';
    const INT               = 'int';

    /**
     * An array of expected options
     *
     * @var Array
     */
    protected static $expected = array();

    /**
     * An array of option positions
     *
     * @var Array
     */
    protected static $varPosition = array();

    /**
     * For validation types
     *
     * @var string
     */
    protected $v_type = 'option';
} // END class InputOption extends ParamBag
