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
        Format::addFormat('newtest', array('foreground' => 'cyan'));

        $str = '<Newtest>Some str</Newtest>';

        $formatted = Format::format($str);

        $this->assertEquals("\33[0;36mSome str\33[0m", $formatted);
    }

    /**
     * Test that adding a format is case insensitive
     *
     * @return void
     */
    public function test_caseInsensitive()
    {
        Format::addFormat('TEST', array('foreground' => 'cyan'));
        Format::addFormat('test2', array('foreground' => 'cyan'));

        $str1 = Format::format('<Test>teststr</Test>');
        $str2 = Format::format('<Test2>teststr</Test2>');

        $this->assertNotContains('Test', $str1);
        $this->assertNotContains('Test2', $str2);
    }
} // END class FormatTest extends \PHPUnit_Framework_TestCase
