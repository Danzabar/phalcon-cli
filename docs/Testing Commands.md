Testing Commands
================

The `Command Tester` class is a fake application that lets you capture the input and output of a task to properly test it. It is very simple to use, you can test a command like:

	$ct = new CommandTester;
	$ct->execute('task:action', $params);

The command tester runs the command and captures the output with output buffering, you can get the output back with the `getOutput` method:

	$ct->getOutput();

You can mock the input for a question using the setInput method, lets look at a chunk of code that would use the command tester and test a question:

	$ct = new CommandTester;
	$ct->setInput("Y\n");
	$ct->execute('task:question');
	
	$ct->getOutput();

The above will answer `Y` to the first question thats asked, you can add more answers for more confirmations or questions, just seperate them with `\n`
