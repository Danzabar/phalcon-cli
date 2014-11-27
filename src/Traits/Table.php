<?php namespace Danzabar\CLI\Traits;

/**
 * The table trait lets to create tables by passing arrays
 *
 *
 */
Trait Table
{
	
	/**
	 * Draws a table from the array passed to it.
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function drawTable(Array $data)
	{
		$lengths = $this->calcLength($data);

		$this->writeHeaders($lengths);

		$this->writeData($data, $lengths);

		$this->writeFooter($lengths);
	}

	/**
	 * Writes the table 
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function writeData(Array $data, Array $lengths)
	{
		foreach($data as $row)
		{
			$rowOutput = '|';

			foreach($row as $key => $value)
			{
				$rowOutput .= ' '.str_pad($value, $lengths[$key], ' ', STR_PAD_RIGHT).' |';
			}

			$this->output->writeln($rowOutput);
		}	
	}

	/**
	 * Writes a decorative footer
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function writeFooter(Array $headers)
	{
		$bar = '+';

		foreach($headers as $name => $length)
		{
			$bar .= str_pad('', $length + 2, '-').'+';
		}

		$this->output->writeln($bar);
	}

	/**
	 * Outputs the headers with padding previously calculated
	 *
	 * @return void
	 * @author Dan Cox
	 */
	public function writeHeaders(Array $headers)
	{
		$bar = '+';
		$header = '|';

		foreach($headers as $name => $length)
		{
			$bar .= str_pad('', $length + 2, '-').'+';	

			$header .= ' '.str_pad($name, $length, ' ', STR_PAD_RIGHT).' |';
		}

		$this->output->writeln($bar);
		$this->output->writeln($header);
		$this->output->writeln($bar);
	}

	/**
	 * Calculate the length of the table
	 *
	 * @return Array
	 * @author Dan Cox
	 */
	public function calcLength(Array $data)
	{
		$lengths = Array();
		
		foreach($data as $table)
		{
			foreach($table as $key => $value)
			{
				$len = strlen($value);

				if(!isset($lengths[$key]) || $len > $lengths[$key])
				{
					$lengths[$key] = $len;
				}	

				if(isset($lengths[$key]) && strlen($key) > $lengths[$key])
				{
					$lengths[$key] = strlen($key);
				}
			}
		}	

		return $lengths;
	}

}
