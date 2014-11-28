<?php namespace Danzabar\CLI\Format;

use Danzabar\CLI\Format\Colors;

/**
 * The format collection stores and fetches formats
 *
 * @package CLI
 * @subpackage Format
 * @author Dan Cox
 */
class FormatCollection
{

	/**
	 * An associative array of formats
	 *
	 * @var Array
	 */
	protected $formats;

	/**
	 * An instance of the Colors class
	 *
	 * @var string
	 */
	protected $color;

	/**
	 * Set up the basic formats
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function __construct()
	{
		$this->formats = Array();

		$this->color = new Colors;

		$this->addGeneric();
	}

	/**
	 * Adds a format entry
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function add($name, Array $details)
	{
		$this->formats[$name] = $this->textToCode($details);
	}

	/**
	 * Turns a text color ie "Blue" into a color code.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function textToCode(Array $details)
	{
		$formatted = Array();

		if(isset($details['foreground']))
		{
			$formatted['foreground'] = $this->color->getForeground($details['foreground']);
		}

		if(isset($details['background']))
		{
			$formatted['background'] = $this->color->getBackground($details['background']);
		}

		return $formatted;
	}

	/**
	 * Gets either a single or all formats depending on the var that is passed
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function get($name = NULL)
	{
		if(!is_null($name))
		{
			if(array_key_exists($name, $this->formats))
			{
				return $this->formats[$name];
			}

			return false;

		} else
		{
			return $this->formats;
		}
	}

	/**
	 * Adds a generic set of formats.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function addGeneric()
	{
		// Questions
		$this->formats->add('question', Array('foreground' => '', 'background' => ''));

		// Comments
		$this->formats->add('comment', Array('foreground' => '', 'background' => ''));
	}

} // END class FormatCollection
