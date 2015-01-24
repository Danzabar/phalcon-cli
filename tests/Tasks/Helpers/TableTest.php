<?php

use Danzabar\CLI\CommandTester,
	Danzabar\CLI\Tasks\Helpers\Table;

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
	 * Test the function that calculates the length of the headers, if this is correct our display will always be ok
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_calculateLength()
	{	
		$table = new Table;

		$testArr = Array(
			0 => Array('Header1' => 'value', 'LongerHeader2' => 'value2'),
			1 => Array('Header1' => 'longer val', 'LongerHeader2' => ''),
			2 => Array('Header1' => 'value', 'LongerHeader2' => 'testvalue')
		);

		$lengths = $table->calcLength($testArr);

		$this->assertEquals(10, $lengths['Header1']);
		$this->assertEquals(13, $lengths['LongerHeader2']);
	}
	
} // END class TableTest extends \PHPUnit_Framework_Testcase
