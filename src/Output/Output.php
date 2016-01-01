<?php namespace Danzabar\CLI\Output;

use Danzabar\CLI\Output\OutputInterface;
use Danzabar\CLI\Format\Format;

/**
 * The output class writes to the console.
 *
 * @package CLI
 * @subpackage Output
 * @author Dan Cox
 */
class Output implements OutputInterface
{
    /**
     * The STDOut
     *
     * @var Resource
     */
    protected $output;

    /**
     * Build the output
     *
     * @return void
     * @author Dan Cox
     */
    public function __construct($source = 'php://output')
    {
        new Format;
        $this->output = fopen($source, "w+");
    }

    /**
     * Output a string
     *
     * @return void
     * @author Dan Cox
     */
    public function write($str)
    {
        fputs($this->output, Format::format($str));
    }

    /**
     * Write a single line
     *
     * @return void
     * @author Dan Cox
     */
    public function writeln($str)
    {
        fputs($this->output, Format::format($str)."\n");
    }

    /**
     * Draws a line with a given length and character
     *
     * @return String
     * @author Dan Cox
     */
    public function hr($length, $char = '_')
    {
        $this->writeln(str_pad('', $length, $char));
    }

    /**
     * Read the output
     *
     * @return void
     * @author Dan Cox
     */
    public function read()
    {
        fseek($this->output, 0);
        return stream_get_contents($this->output);
    }
} // END class Output
