Installation
============

Use the following instructions to start using the CLI - Although remember, you will need the [phalcon framework](http://phalconphp.com/) installed!

### Composer

To install using composer add it to the list of dependencies in the composer.json file.

	"danzabar/phalcon-cli": "1.x"


## The Application

You will first need an application to use the CLI tools with. The following is a basic instruction of how to set up a basic app, but you are free to expand on this as there might be configurations or specific DI elements you want to add onto it.

	#!/usr/bin/env php
	<?php

	$di = ''; // Set your phalcon DI up


	$app = new Danzabar\CLI\Application;
	$app->setDI($di);

	// Add your commands!
	$app->add(new Task);

	try {

		$app->start($argv);

	} catch (\Exception $e) {

		echo $e->getMessage();
		exit(255);
	}


Now you will have a fully setup application that you can bind Commands to. You can use this by using...

	php cli Task:action params

## Defining Commands

Expanding on Phalcon's base CLI tools you can add your commands to the application. This allows the CLI to report on missing tasks, it also gives you the oppurtunity to specify a usable name for the task rather than having the Classname:action combination. So to add your command class, just use the apps `add` method:

	$app->add(new CommandTask);

Once its loaded into the apps command library you can access it by using the `find` method and giving its name, for example we named the above `command`:

	// Find it with an action name appended, which also validates the action
	$app->find('command:main');

## Adding a suffix onto tasks or actions

By default there is no longer any suffix for tasks or actions, so if your calling the main action it will look for the method `main` - Although if you prefered the old way, or even a different way, then you can change it:

	$app->setActionSuffix('Action');

Bare in mind with tasks, you are specifically adding that class.. So there is no need to edit the suffix.
