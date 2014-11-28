<?php namespace Danzabar\CLI\Format;

use Danzabar\CLI\FormatCollection;

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
	protected $collection;

	/**
	 * Set up class
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct($collection = NULL)
	{
		$this->collection = (!is_null($collection) ? $collection : new FormatCollection);
	}

	/**
	 * Adds a format to the collection object
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function addFormat($name, Array $details)
	{
		$this->collection->add($name, $details);
	}

	/**
	 * Checks a string for format codes and replaces it with its background/foreground color codes
	 *
	 * @return String
	 * @author Dan Cox
	 */
	public function format($str)
	{


	}
		

} // END class Format
