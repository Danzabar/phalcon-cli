<?php

namespace Danzabar\CLI\Tools;

/**
 * The param bag acts as a base for param bag type classes
 *
 * @package CLI
 * @subpackage Tools
 * @author Dan Cox
 */
class ParamBag
{
    /**
     * Array of parameters
     *
     * @var Array
     */
    protected $params = array();

    /**
     * Returns the param by name
     *
     * @return Mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        }

        return false;
    }

    /**
     * Bulk load values
     *
     * @return $this
     */
    public function load(array $values)
    {
        $this->params = $values;

        return $this;
    }

    /**
     * Sets a value
     *
     * @return $this
     */
    public function __set($name, $value)
    {
        $this->params[$name] = $value;

        return $this;
    }

    /**
     * Check if var isset
     *
     * @return Boolean
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->params);
    }

    /**
     * Unset a variable
     *
     * @return $this
     */
    public function __unset($name)
    {
        unset($this->params[$name]);

        return $this;
    }

    /**
     * Clears all the params
     *
     * @return $this
     */
    public function clear()
    {
        $this->params = array();

        return $this;
    }

    /**
     * Returns all the params
     *
     * @return Array
     */
    public function all()
    {
        return $this->params;
    }
} // END class ParamBag
