Helpers
=======

Helpers are addons that provide some functionality to commands. By default the helper class comes with 3 loaded helpers, questions, tables, confirmations. You can add your own helpers and even overwrite the current helpers. Because you only need to pass the class name to the helper to register it, there is no overhead from loading a load of helpers. Heres how you would go about creating your own helper class

	class MyHelper extends Danzabar\CLI\Tasks\Helpers\Helper
	{
		// Add your functionality.	
	}

	// When you are setting up the app, register your helper
	$app = new Application;

	$app->helpers()->registerHelper('myhelper', 'MyHelper');

	// Now in your Task class you can load this to return an instance of your helper
	$myHelper = $this->helpers->load('myhelper');

The helpers class does not autoload your class, that is down to you, so just make sure your class is accessible.
