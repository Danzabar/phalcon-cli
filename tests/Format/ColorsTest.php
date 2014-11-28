<?php

use Danzabar\CLI\Format\Colors;

/**
 * Test case for the colors class
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class ColorsTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * An instance of the color class
	 *
	 * @var Object
	 */
	protected $color;

	/**
	 * Init colors obj
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->color = new Colors;
	}

	/**
	 * Test that it gets the correct colors
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_correctColor()
	{
		$fBlack = $this->color->getForeground('black');
		$fPurple = $this->color->getForeground('purple');	

		$bBlack = $this->color->getBackground('black');
		$bCyan = $this->color->getBackground('cyan');

		$this->assertEquals('0;30', $fBlack);
		$this->assertEquals('0;35', $fPurple);
		$this->assertEquals(40, $bBlack);
		$this->assertEquals(46, $bCyan);
	}

} // END class ColorsTest extends \PHPUnit_Framework_TestCase
