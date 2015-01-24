<?php

use Danzabar\CLI\Command,
	Danzabar\CLI\Traits;

/**
 * The utility task
 *
 * @package CLI
 * @subpackage Test
 * @author Dan Cox
 */
class UtilityTask extends Command
{
	use Traits\Table;

	/**
	 * The task name
	 *
	 * @var string
	 */
	protected $name = 'utility';
	
	/**
	 * Description
	 *
	 * @var string
	 */
	protected $description = 'This is the utility task.';

	/**
	 * The main action
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function main()
	{
		$this->output->writeln("The main action of the utility task");
	}

	/**
	 * Draws a table
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function table()
	{
		$data = Array();
		$data[] = Array('Header1' => 'Value', 'Header2' => 'Value2');
		$data[] = Array('Header1' => 'Longer value', 'Header2' => '');	

		$this->drawTable($data);
	}
	
} // END class UtilityTask extends Command
