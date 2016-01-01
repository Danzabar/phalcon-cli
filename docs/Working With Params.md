Working with parameters
=======================

There are two types of parameters you can set, Arguments and Options. Although these are discussed in another Doc file, we should have a breif look at this and cover some info that relates to both of them.

You specify expected arguments and options in `setup` methods, there are currently two ways of doing this.. you can use a global setup method like:

	public function setup($action)
	{
		$this->argument->addExpected('name', InputArgument::REQUIRED);
	}

While this is quicker, if you have an action that requires a set of different arguments, you can use a setup method specific to that action, lets pretend we call the 'output' action, our setup for this would be like:

	public function setupOutput()
	{
		$this->option->addExpected('verbose', InputOption::OPTIONAL);
	}

This gives you control over your actions arguments and options, but also where needed allows you to generalise and not rewrite code.
