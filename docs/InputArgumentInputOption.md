Input Arguments and Input Options
=================================

As well as using a param variable in the action you can now define arguments and options. This is currently a work in progress so there maybe some bugs with it and its implemented in a very basic form.

## Arguments

The `InputArgument` class allows you to set expected and get given arguments, arguments are defined as any parameter after the `task:action` text. Your task classes can define expected arguments, by using a method called `setup` like so

	Class Task extends Command
	{
	
		public function setup($action)
		{
			$this->argument->setExpected('name', InputArgument::Required);	

			// You can also specify via actions
			if($action == 'listAction')
			{
				$this->argument->setExpected('format', InputArgument::Optional);
			}
		}

		public function mainAction()
		{
			// To use the name argument, simply
			$this->output->writeln($this->argument->name);
		}
	}

## Options

Very similar process to arguments, only we use `option`. An option must be preceeded with -- for example `--verbose` is an option, currently they can have no values and are used only as flags or switches:

	Class Task extends Command
	{
		public function setup()
		{
			$this->option->setExpected('verbose', InputOption::Optional);
		}

		public function mainAction()
		{
			if(isset($this->option->verbose))
			{
				$this->output->writeln('verbose mode on');
			}
		}
	}
