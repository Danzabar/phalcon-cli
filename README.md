CLI Tools for the Phalcon Framework
===================================

[![Build Status](https://travis-ci.org/Danzabar/phalcon-cli.svg?branch=master)](https://travis-ci.org/Danzabar/phalcon-cli) [![Coverage Status](https://coveralls.io/repos/Danzabar/phalcon-cli/badge.png?branch=master)](https://coveralls.io/r/Danzabar/phalcon-cli?branch=master)

An expansion to the Phalcon Frameworks CLI Classes. This includes things like Questions, Confirmation, Command test class, Input/Output Streams and Application wrapper that allows you to start a CLI with minimal Effort.

This is still a work in progress at the moment, so more details including documentation and examples will follow.

## Usage

Install this via composer by including `"danzabar/phalcon-cli":"dev-master"` in your require list.

## Writing Commands

Commands or tasks can be writen by first extending the Command class, `Danzabar\CLI\Command`. The Command class gives your class access to the input and output classes ie. `$this->input`, `$this->output`. Heres an example of a basic Command Class

	Class TestTask extends \Danzabar\CLI\Command {
		
		protected $name = ''; // This is used in the automated help command

		protected $description = '';

		public function writeAction(Array $params) {
			
			$this->output->writeln('Write a line');
			$this->output->write('Just a plain ole write');
		}

	}

## Traits

There are several traits that can add interactivity and save you time, at the moment there is;

### Questions

The question trait allows you to get user input via questions, To use this, add the trait to a class. The most basic way to ask a question is with the `ask` function.

	$answer = $this->ask('Do you like questions?');

There are also choice questions, which pose a question with a list of answers one of which must be selected.

	$answer = $this->choice('Pick one of these', Array('one', 'two'));

You can also ask a multiple choice question which can return multiple answers seperated by a comma

	$answers = $this->multipleChoice('Pick two of these', Array('one', 'two', 'three'));

### Confirmation

The confirmation trait asks the user to confirm an action, eg "Do you wish to continue?";

	if($this->confirm('Do you really wanna do this, tough guy?'))
	{
		// Action
	}

### Table

The table trait gives you the ability to output a table in one function on the command line. First you must have an array of associative arrays, and pass this to the `drawTable` function;

	$data = Array(
		0 => Array('Header' => 'value', 'Header2' => 'value2'),
		1 => Array('Header' => 'test', 'Header2' => 'value3')
	);

	$this->drawTable($data);

## Format

You can add some color to output with the format class, it allows you to add a foreground and background color. To use this just `use Danzabar\CLI\Format\Format`;

	// Add a new Style
	Format::addFormat('style', Array('foreground' => 'cyan', 'background' => 'black'));

	// To use this just wrap your str in a marquee with the name of your style eg.
	$this->output->write('<Style>this str will be cyan with a black background.</Style>');

There are 3 already set up styles, but you can override them, they are:

	<Question></Question>
	<Comment></Comment>
	<Error></Error>

Have a look in `Danzabar\CLI\Format\Colors` class for a list of foreground and background colors.

## Testing Commands

This comes with a Command Tester class that allows you to load a fake instance of the application and command and unit test it with PHPunit or similar. To do this, simply

	$ct = new CommandTester;
	$ct->execute('Task:action', $params);

	$ct->getOutput();

For those times that you need to emulate user input on a test;

	$ct->setInput("Y\n");

	// If you have multiple input needs
	$ct->setInput("Y\n N\n Y\n");

## Look to the source

The source code and tests contain a lot of usage practises and tricks for using this, so if you are unsure, take a look it might point you in the right direction!

## Contributing
If you want to contribute, great. Just fork this repo and make a pull request with changes. 
