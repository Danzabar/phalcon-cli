<?php namespace Danzabar\CLI\Tasks\Helpers;

/**
 * The helper base class to give basic functionality to any extending helpers
 *
 * @package CLI
 * @subpackage Tasks\Helpers
 * @author Dan Cox
 */
class Helper
{
	/**
	 * The DI instance
	 *
	 * @var Object
	 */
	protected $di;

	/**
	 * Output instance
	 *
	 * @var Object
	 */
	protected $output;

	/**
	 * Input Instance
	 *
	 * @var string
	 */
	protected $input;

	/**
	 * Set up the helper class
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($di = NULL)
	{
		if(!is_null($di))
		{
			$this->di = $di;
			$this->output = $this->di->get('output');
			$this->input = $this->di->get('input');
		}
	}

	/**
	 * Returns the di
	 *
	 * @return DI
	 * @author Dan Cox
	 */
	public function getDI()
	{
		return $this->di;
	}

} // END class Helper
