<?php

namespace Danzabar\CLI\Format;

/**
 * The colors class stores and fetches color codes for the cl
 *
 * @package CLI
 * @subpackage Format
 * @author Dan Cox
 */
class Colors
{

    /**
     * An associative array storing foreground colors by name
     *
     * @var Array
     */
    protected $foreground;

    /**
     * An associative array storing background colors by name
     *
     * @var Array
     */
    protected $background;

    /**
     * Set up the colors array
     *
     * @return void
     */
    public function __construct()
    {
        $this->populateForeground();

        $this->populateBackground();
    }

    /**
     * Gets a foreground color code by its name
     *
     * @return void
     */
    public function getForeground($name)
    {
        if (array_key_exists($name, $this->foreground)) {
            return $this->foreground[$name];
        }

        return false;
    }

    /**
     * Gets a background color code by its name
     *
     * @return void
     */
    public function getBackground($name)
    {
        if (array_key_exists($name, $this->background)) {
            return $this->background[$name];
        }

        return false;
    }

    /**
     * Adds colors to the foreground array
     *
     * @return void
     */
    public function populateForeground()
    {
        $this->foreground = array(
            'black'             => '0;30',
            'dark_gray'             => '1;30',
            'blue'              => '0;34',
            'light_blue'        => '1;34',
            'green'             => '0;32',
            'light_green'       => '1;32',
            'cyan'              => '0;36',
            'light_cyan'        => '1;36',
            'red'               => '0;31',
            'light_red'             => '1;31',
            'purple'            => '0;35',
            'light_purple'      => '1;35',
            'brown'                 => '0;33',
            'yellow'            => '1;33',
            'light_gray'        => '0;37',
            'white'                 => '1;37'
        );
    }

    /**
     * Adds background color entries
     *
     * @return void
     */
    public function populateBackground()
    {
        $this->background = array(
            'black'                 => 40,
            'red'               => 41,
            'green'                 => 42,
            'yellow'            => 43,
            'blue'              => 44,
            'magenta'           => 45,
            'cyan'              => 46,
            'light_gray'        => 47
        );
    }
} // END class Colors
