Installation
============

Use the following instructions to start using the CLI - Although remember, you will need the [phalcon framework](http://phalconphp.com/) installed!

### Composer

To install using composer add it to the list of dependencies in the composer.json file.

	"danzabar/phalcon-cli": "0.2.x"


## The Application

You will first need an application to use the CLI tools with. The following is a basic instruction of how to set up a basic app, but you are free to expand on this as there might be configurations or specific DI elements you want to add onto it.

	#!/usr/bin/env php

	$di = ''; // Set your phalcon DI up


	$app = new Danzabar\CLI\Application;
	$app->setDI($di);

	try {
		
		$app->start($argv);

	} catch (\Exception $e) {
		
		echo $e->getMessage();
		exit(255);
	}


Now you will have a fully setup application that you can bind Commands to. You can use this by using...

	php cli Task:action params
