Input Arguments and Input Options
=================================

You can specify argument and option parameters in each task, you can add validation rules for these params. As mentioned in the previous DOC file you can make specific setup rules by including the action name in the setup, you can just use the generic `setup` method too, which gets passed an string with the action name called in.

## Arguments

The `InputArgument` class allows you to set expected and get given arguments, arguments are defined as any parameter after the `task:action` text. Your task classes can define expected arguments, by using a method called `setup` like so

	Class Argument extends Task
	{

		public function setup($action)
		{
			$this->argument->addExpected('name', InputArgument::REQUIRED);
		}

		public function main()
		{
			// To use the name argument, simply
			$this->output->writeln($this->argument->name);
		}
	}

## Options

Very similar process to arguments, only we use `option`. An option must be preceeded with -- or - for example `--verbose or -verbose` is an option, Options can also contain values, for example --name="my name" or -name="my name"

	Class Option extends Task
	{
		public function setupMain()
		{
			$this->option->addExpected('verbose', InputOption::OPTIONAL);
		}

		public function main()
		{
			if(isset($this->option->verbose))
			{
				$this->output->writeln('verbose mode on');
			}
		}
	}

## Validation

Adding an expected option or argument means you can add validation to them, you can pass a single rule or multiple in an array like so:

	$this->argument->addExpected('argument', Array(InputArgument::Required, InputArgument::Alpha));

Current validation rules are;-

#### Arguments

 - OPTIONAL, the argument is only optional
 - REQUIRED, the argument is required and will throw an exception if its not set
 - ALPHA, the argument can only consist of alpha characters

#### Options

 - OPTIONAL
 - REQUIRED, this means that the option must be set, whether value or flag
 - VALUEREQUIRED, this means that the option must contain a value

