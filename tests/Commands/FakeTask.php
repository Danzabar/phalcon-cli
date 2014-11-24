<?php

use Danzabar\CLI\Command;

/**
 * A test command
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class FakeTask extends Command
{

	/**
	 * The name
	 *
	 * @var string
	 */
	protected $name = 'Test command';

	/**
	 * The test description
	 *
	 * @var string
	 */
	protected $description = 'The test command provides no use, it has no purpose, it just exists.';

	/**
	 * The main action for this command
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function mainAction()
	{
		echo 'main action';
	}

} // END class TestCommand extends Command
