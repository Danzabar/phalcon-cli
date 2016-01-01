<?php

use Danzabar\CLI\CommandTester;
use Danzabar\CLI\Tasks\Helpers\Table;

/**
 * Test case for the table trait
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class TableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * The command tester instance
     *
     * @var Object
     */
    protected $CT;

    /**
     * Set up test vars
     *
     * @return void
     * @author Dan Cox
     */
    public function setUp()
    {
        $this->CT = new CommandTester();
        $this->CT->add(new UtilityTask);
    }

    /**
     * Test the table drawing functionality.
     *
     * @return void
     * @author Dan Cox
     */
    public function test_table()
    {
        $this->CT->execute('utility:table');

        $this->assertContains('Header1', $this->CT->getOutput());
        $this->assertContains('Header2', $this->CT->getOutput());
    }

    /**
     * Test the function that calculates the length of the headers, if this is correct our display will always be ok
     *
     * @return void
     * @author Dan Cox
     */
    public function test_calculateLength()
    {
        $table = new Table;

        $testArr = array(
            0 => array('Header1' => 'value', 'LongerHeader2' => 'value2'),
            1 => array('Header1' => 'longer val', 'LongerHeader2' => ''),
            2 => array('Header1' => 'value', 'LongerHeader2' => 'testvalue')
        );

        $lengths = $table->calcLength($testArr);

        $this->assertEquals(10, $lengths['Header1']);
        $this->assertEquals(13, $lengths['LongerHeader2']);
    }
} // END class TableTest extends \PHPUnit_Framework_Testcase
