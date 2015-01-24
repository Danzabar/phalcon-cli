<?php

use Danzabar\CLI\Tasks\Helpers,
	Phalcon\DI;

/**
 * Test case for the helper class
 *
 * @package CLI
 * @subpackage Tests\Tasks
 * @author Dan Cox
 */
class HelperTest extends \PHPUnit_Framework_TestCase
{
	
	/**
	 * Instance of the helper class
	 *
	 * @var Object
	 */
	protected $helpers;

	/**
	 * Set up test vars
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$di = new DI;
		$this->helpers = new Helpers($di);
	}

	/**
	 * Test registering and getting helper
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_registerAndGetHelper()
	{
		$this->helpers->registerHelper('utility.question', 'ClassName');

		$this->assertEquals('ClassName', $this->helpers->getRegisteredHelper('utility.question'));
	}

} // END class HelperTest extends \PHPUnit_Framework_TestCase
