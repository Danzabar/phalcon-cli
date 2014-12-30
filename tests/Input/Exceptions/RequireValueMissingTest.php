<?php

use Danzabar\CLI\Input\Exceptions\RequiredValueMissingException;

/**
 * Test case for the Require value missing exception.
 *
 * @package CLI
 * @subpackage Tests\Exceptions
 * @author Dan Cox
 */
class RequiredValueMissingTest extends \PHPUnit_Framework_TestCase
{
	
	/**
	 * Test firing exception
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function test_fireException()
	{
		try {
	
			throw new RequiredValueMissingException('option', 'verbose');

		} catch (\Exception $e) {
			
			$this->assertEquals('option', $e->getType());
			$this->assertEquals('verbose', $e->getKey());
		}
	}

} // END class RequiredValueMissingTest extends \PHPUnit_Framework_TestCase
