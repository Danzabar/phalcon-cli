<?php

use Phalcon\Loader;


/**
 * The Test environment...
 * We just need composer autoloader.
 *
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Create a loader for the commands
 *
 */
$loader = new Loader;
$loader->registerDirs(Array(__DIR__.'/Commands'));
$loader->register();
