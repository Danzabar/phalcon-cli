Tables
======

The `Danzabar\CLI\Traits\Table` trait allows you to create tables from arrays. The table trait gives you the ability to output a table in one function on the command line. First you must have an array of associative arrays, and pass this to the drawTable function:

	$data = Array(
		0 => Array('Header' => 'value', 'Header2' => 'value2'),
		1 => Array('Header' => 'test', 'Header2' => 'value3')
	);

	$this->drawTable($data);
