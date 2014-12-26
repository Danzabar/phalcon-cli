<?php

use Danzabar\CLI\Format\FormatCollection;

/**
 * Test class for the format collection
 *
 * @package CLI
 * @subpackage Test
 * @author Dan Cox
 */
class CollectionTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * An instance of the collection class
	 *
	 * @var Object
	 */
	protected $collection;


	/**
	 * Initiate the collection
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function setUp()
	{
		$this->collection = new FormatCollection;
	}

	/**
	 * Test adding and getting a collection
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_addget()
	{
		$this->collection->add('test', Array('foreground' => 'black', 'background' => 'black'));

		$this->assertEquals(
			Array('foreground' => '0;30', 'background' => 40),
			$this->collection->get('test')
		);
	}

	/**
	 * Test the default values that get auto added
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_defaults()
	{
		$this->assertEquals(
			Array('foreground' => '0;36'),
			$this->collection->get('question')
		);

		$this->assertEquals(
			Array('foreground' => '1;33'),
			$this->collection->get('comment')
		);

		$this->assertEquals(
			Array('foreground' => '1;37', 'background' => 41),
			$this->collection->get('error')
		);
	}

	/**
	 * Test that returns false when the name doesnt exist
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_returnFalseOnFakeName()
	{
		$this->assertFalse($this->collection->get('fake'));
	}

	/**
	 * Test that the collection returns all on a NULL name
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_returnAllOnNullName()
	{
		$collections = $this->collection->get();

		$this->assertTrue(array_key_exists('question', $collections));
		$this->assertTrue(array_key_exists('comment', $collections));
		$this->assertTrue(array_key_exists('error', $collections));
	}

} // END class CollectionTest extends \PHPUnit_Framework_TestCase
