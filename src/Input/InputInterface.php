<?php namespace Danzabar\CLI\Input;

/**
 * The input interface
 *
 * @package Input
 * @author Dan Cox
 */
interface InputInterface
{

    /**
     * The get input function should return the input string
     *
     * @return void
     * @author Dan Cox
     */
    public function getInput();
}
