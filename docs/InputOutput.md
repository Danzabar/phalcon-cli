Input and Output
================

The input and output classes use PHP's STDIN and STDOUT, they allow you to wait for responses from the user and output either chunks of text or line by line. In every task the input and output is provided as a class variable...

	$this->input

	$this->output

## Input

The input class is very simple to use, and can be replaced by your own input class if you set it in the DI. Its most common usage would be... to get a users response from a question/comment/poll or whatever. To do this you can use the getInput method:

	$this->input->getInput();

Simple as that! There might also be a time where you want to Mock the input to test a question, to do this we need to change the source of the input:
	
	// change the source to memory
	$this->input = new Input('php://memory');
	
	// Set your mocked answer/answers (for multiple questions seperate with \n);
	$this->input->mock("Y\nN\n");

	// Put it back in the DI
	$this->DI->setShared('input', $this->input);

There is already a command tester class that does this in one method, but its also nice to know what its doing!

## Output

The output writes your strings to the console, it only has 2 methods and works in a very simple manor. It also uses the Format class to format text as its being printed, looking for the marquee's that signify what format the string should be. The output class allows you to:

	// Write a chunk of text
	$this->output->write("This is a chunk of text with no new line at the end");

	// Write a line
	$this->output->writeln("This will have a new line at the end");

You can replace your own Output class by using the DI in the same fashion as the Input, if you are doing this though, just remember to include the format class unless you dont need/want it. 
