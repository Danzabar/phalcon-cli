<?php

namespace Danzabar\CLI\Input;

use Danzabar\CLI\Input\InputInterface;

/**
 * The input stream from the console
 *
 * @package CLI
 * @subpackage Input
 * @author Dan Cox
 */
class Input implements InputInterface
{

    /**
     * The STDIn resource
     *
     * @var Resource
     */
    protected $inputStream;

    /**
     * The raw input captured through STDIn
     *
     * @var String
     */
    protected $input;

    /**
     * The source of the input (For input mocking)
     *
     * @var String
     */
    protected $inputSource;

    /**
     * Create the stream
     *
     * @param String $source - The source of the input stream
     */
    public function __construct($source = 'php://stdin')
    {
        $this->inputStream = fopen($source, "r+", false);
    }

    /**
     * Mock an input string
     *
     * @param String $str - The string to add to input
     * @return Input
     */
    public function mock($str)
    {
        fputs($this->inputStream, $str);
        rewind($this->inputStream);

        return $this;
    }

    /**
     * Read the input stream
     *
     * @return Boolean
     */
    public function read()
    {
        $this->input = fgets($this->inputStream);

        return true;
    }

    /**
     * Returns the raw captured input
     *
     * @return String
     */
    public function getInput()
    {
        $this->read();

        return trim($this->input);
    }
} // END class Input
