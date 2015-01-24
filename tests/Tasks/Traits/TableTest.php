<?php

use Danzabar\CLI\CommandTester,
	Danzabar\CLI\Tasks\Traits\Table;

/**
 * Test case for the table trait
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class TableTest extends \PHPUnit_Framework_TestCase
{
	use Table;

	/**
	 * The command tester class
	 *
	 * @var Object
	 */
	protected $CT;

	/**
	 * Set up the command tester
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->CT = new CommandTester;

		$this->CT->add(new UtilityTask);
	}

	/**
	 * Test drawing functions
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_draw()
	{
		$this->CT->execute('utility:table');

		// Assert that all our data is there
		$this->assertContains('Value', $this->CT->getOutput());	
		$this->assertContains('Value2', $this->CT->getOutput());
		$this->assertContains('Longer value', $this->CT->getOutput());
	}

	/**
	 * Test the function that calculates the length of the headers, if this is correct our display will always be ok
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_calculateLength()
	{	
		$testArr = Array(
			0 => Array('Header1' => 'value', 'LongerHeader2' => 'value2'),
			1 => Array('Header1' => 'longer val', 'LongerHeader2' => ''),
			2 => Array('Header1' => 'value', 'LongerHeader2' => 'testvalue')
		);

		$lengths = $this->calcLength($testArr);

		$this->assertEquals(10, $lengths['Header1']);
		$this->assertEquals(13, $lengths['LongerHeader2']);
	}
	
} // END class TableTest extends \PHPUnit_Framework_Testcase
