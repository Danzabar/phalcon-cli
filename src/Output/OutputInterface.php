<?php

namespace Danzabar\CLI\Output;

/**
 * The output interface governs output classes for the CLI,
 * Should you want to create your own module for output, or use a different method.
 *
 * @package Output
 * @author Dan Cox
 */
interface OutputInterface
{

    /**
     * The write function to simply write a string
     *
     * @return void
     */
    public function write($str);

    /**
     * Write a line
     *
     * @return void
     */
    public function writeln($str);
}
