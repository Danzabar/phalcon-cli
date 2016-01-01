<?php

use Danzabar\CLI\Application;
use Phalcon\Loader;
use \Mockery as m;

/**
 * Test case for the application class
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of the application class
     *
     * @var Object
     */
    protected $application;


    /**
     * Set up the test environment
     *
     * @return void
     * @author Dan Cox
     */
    public function setUp()
    {
        $this->application = new Application();
        $this->application
                    ->setName('Test CLI')
                    ->setVersion('1.0');
    }

    /**
     * Check that the name and version is correct
     *
     * @return void
     * @author Dan Cox
     */
    public function test_nameAndVersion()
    {
        $this->assertEquals('Test CLI', $this->application->getName());
        $this->assertEquals('1.0', $this->application->getVersion());
    }

    /**
     * Test that everything is set as it should be
     *
     * @return void
     * @author Dan Cox
     */
    public function test_vars()
    {
        $this->assertInstanceOf('Phalcon\DI', $this->application->getDI());
    }

    /**
     * Test firing a command
     *
     * @return void
     * @author Dan Cox
     */
    public function test_fireCommand()
    {
        $app = new Application;
        $app->add(new FakeTask);

        ob_start();

            $command = $app->start(array('cli', 'fake'));

            $content = ob_get_contents();

            ob_end_clean();

            $this->assertContains('main action', $content);
            $this->assertInstanceOf('Danzabar\CLI\Input\Input', $command->getInput());
            $this->assertInstanceOf('Danzabar\CLI\Output\Output', $command->getOutput());
    }

    /**
     * Test that the input and output are set properly
     *
     * @return void
     * @author Dan Cox
     */
    public function test_SetOutputInput()
    {
        $app = new Application;
        $app->add(new FakeTask);
        $command = $app->start(array('cli', 'fake:output'));

        $this->assertInstanceOf('\Danzabar\CLI\Output\Output', $command->getOutput());
        $this->assertInstanceOf('\Danzabar\CLI\Input\Input', $command->getInput());
    }

    /**
     * Test adding a fetching commands from the library
     *
     * @return void
     * @author Dan Cox
     */
    public function test_interactionsWithLibrary()
    {
        $app = new Application;
        $app->add(new FakeTask);

        $command = $app->find('fake:output');

        $this->assertInstanceOf('FakeTask', $command);
    }

    /**
     * Test that an exception is throw when trying to find a task that doesnt exist
     *
     * @return void
     * @author Dan Cox
     */
    public function test_fireExceptionOnNoCommandFound()
    {
        $this->setExpectedException('Danzabar\CLI\Tasks\Exceptions\CommandNotFoundException');

        $app = new Application;
        $app->find('task:action');
    }

    /**
     * Test that an exception fires when trying to find a command with the right task name but wrong action
     *
     * @return void
     * @author Dan Cox
     */
    public function test_fireExceptionWhenTaskFoundButNotAction()
    {
        $this->setExpectedException('Danzabar\CLI\Tasks\Exceptions\CommandNotFoundException');

        $app = new Application;
        $app->add(new FakeTask);

        $app->find('fake:action');
    }

    /**
     * Test setting the application suffixes
     *
     * @return void
     * @author Dan Cox
     */
    public function test_settingSuffixes()
    {
        // Will throw an exception because it looks for FakeTaskTask
        $this->setExpectedException('Phalcon\CLI\Dispatcher\Exception');

        $app = new Application;
        $app->setTaskSuffix('Task');
        $app->setActionSuffix('Action');

        $app->add(new FakeTask);
        $app->start(['cli', 'fake']);
    }

    /**
     * Test that the helpers are correctly setup
     *
     * @return void
     * @author Dan Cox
     */
    public function test_helperSetUp()
    {
        $app = new Application;

        $helpers = $app->helpers();

        $this->assertInstanceOf('Danzabar\CLI\Tasks\Helpers\Question', $helpers->load('question'));
        $this->assertInstanceOf('Danzabar\CLI\Tasks\Helpers\Confirmation', $helpers->load('confirm'));
        $this->assertInstanceOf('Danzabar\CLI\Tasks\Helpers\Table', $helpers->load('table'));
    }
} // END class ApplicationTest extends \PHPUnit_Framework_TestCase
