Writing Tasks
=============

As if you was using regular Phalcon CLI tools the tasks must have Task appended to their class name, for example if you had a Git task, you would call it GitTask. With this in mind, lets look at how we write tasks...

	Class BasicTask extends \Danzabar\CLI\Command
	{
	
		// The name will be used in the standard help command
		protected $name = 'Basic'; 

		// The description is used along with the name
		protected $description = 'A basic task that does pretty much nothing';

		
		/**
		 * Every task should have a main method, it will be the default
		 * action that is called if no other is specified.
		 *
		 */
		public function mainAction() 
		{
			$this->output->writeln("This is the main action");	
		}

		public function otherAction(Array $params = Array())
		{
			$this->output->writeln("This is the other action");
		}

	}

The task above will only perform the most basic of actions, to use the main command for this you could write:

	php cli basic

As mentioned in the comments, when you specify no action it will default to main. You can use the other action and pass parameters like this:

	php cli basic:other param1 param2

The parameters will be sent as an array as an argument of the action.

