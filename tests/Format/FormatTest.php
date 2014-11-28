<?php

use Danzabar\CLI\Format\Format;

/**
 * Test case for the formatter class
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class FormatTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * Add the collection
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		new Format;
	}

	/**
	 * Test finding and formatting a string correctly
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_formatStr()
	{
		$str = '<Question>This is a question</Question>';

		$formatted = Format::format($str);

		$this->assertEquals("\33[0;36mThis is a question\33[0m", $formatted);
	}

	/**
	 * Test adding new format and then using it
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_addFormat()
	{	
		Format::addFormat('newtest', Array('foreground' => 'cyan'));

		$str = '<Newtest>Some str</Newtest>';

		$formatted = Format::format($str);

		$this->assertEquals("\33[0;36mSome str\33[0m", $formatted);
	}

} // END class FormatTest extends \PHPUnit_Framework_TestCase
