<?php

namespace Danzabar\CLI\Format;

use Danzabar\CLI\Format\FormatCollection;

/**
 * The format class controls everything to do with formating
 *
 * @package CLI
 * @subpackage Format
 * @author Dan Cox
 */
class Format
{

    /**
     * Instance of the collection
     *
     * @var Object
     */
    protected static $collection;

    /**
     * Set up class
     *
     * @return void
     * @author Dan Cox
     */
    public function __construct($collection = null)
    {
        static::$collection = (!is_null($collection) ? $collection : new FormatCollection);
    }

    /**
     * Adds a format to the collection object
     *
     * @return void
     * @author Dan Cox
     */
    public static function addFormat($name, array $details)
    {
        static::$collection->add($name, $details);
    }

    /**
     * Checks a string for format codes and replaces it with its background/foreground color codes
     *
     * @return String
     * @author Dan Cox
     */
    public static function format($str)
    {
        preg_match('/<[A-Za-z0-9]+?>/', $str, $matches);

        foreach ($matches as $match) {
            $keyword = str_replace(array('<', '>'), '', $match);

            $format = static::$collection->get(strtolower($keyword));

            if (!empty($format)) {
                $foreground = (!isset($format['foreground']) ? '' : "\33[".$format['foreground']."m");
                $background = (!isset($format['background']) ? '' : "\33[".$format['background']."m");

                $str = str_replace(
                    array('<'.$keyword.'>', '</'.$keyword.'>'),
                    array($foreground.$background, "\33[0m"),
                    $str
                );
            }
        }

        return $str;
    }
} // END class Format
