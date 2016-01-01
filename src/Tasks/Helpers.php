<?php namespace Danzabar\CLI\Tasks;

use Danzabar\CLI\Tasks\Exceptions;

/**
 * The helper class adds functionality to the Task class
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class Helpers
{
    /**
     * An array of active helpers
     *
     * @var Array
     */
    protected $active_helpers;

    /**
     * A list of available helpers
     *
     * @var Array
     */
    protected $helpers;

    /**
     * The DI instance
     *
     * @var Object
     */
    protected $di;

    /**
     * Set up class vars
     *
     * @return void
     * @author Dan Cox
     */
    public function __construct($DI)
    {
        $this->active_helpers = array();
        $this->helpers = array();

        $this->di = $DI;
    }

    /**
     * Registers a helper class that can be activated on a command
     *
     * @return Helper
     * @author Dan Cox
     */
    public function registerHelper($name, $className)
    {
        $this->helpers[$name] = $className;
        return $this;
    }

    /**
     * Returns the class name specified against a registered helper class
     *
     * @return String
     * @author Dan Cox
     */
    public function getRegisteredHelper($name)
    {
        if (array_key_exists($name, $this->helpers)) {
            return $this->helpers[$name];
        }

        throw new Exceptions\RegisteredHelperClassNotFoundException($name);
    }

    /**
     * Creates and returns an instance of the helper
     *
     * @return Object
     * @author Dan Cox
     */
    public function load($name)
    {
        $helper = $this->getRegisteredHelper($name);

        $reflection = new \ReflectionClass($helper);
        $class = $reflection->newInstance($this->di);

        return $class;
    }
} // END class Helper
