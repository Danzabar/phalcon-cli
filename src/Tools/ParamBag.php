<?php namespace Danzabar\CLI\Tools;

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
	protected $params;

	/**
	 * Returns the param by name
	 *
	 * @return Mixed
	 * @author Dan Cox
	 */
	public function __get($name)
	{
		if(array_key_exists($name, $this->params))
		{
			return $this->params[$name];	
		}

		return false;
	}

	/**
	 * Bulk load values
	 *
	 * @return $this
	 * @author Dan Cox
	 */
	public function load(Array $values)
	{
		$this->params = $values;

		return $this;
	}

	/**
	 * Sets a value
	 *
	 * @return $this
	 * @author Dan Cox
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
	 * @author Dan Cox
	 */
	public function __isset($name)
	{
		return array_key_exists($name);
	}

	/**
	 * Unset a variable
	 *
	 * @return $this
	 * @author Dan Cox
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
	 * @author Dan Cox
	 */
	public function clear()
	{
		$this->params = Array();

		return $this;
	}

	/**
	 * Returns all the params
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function all()
	{
		return $this->params;
	}


} // END class ParamBag
