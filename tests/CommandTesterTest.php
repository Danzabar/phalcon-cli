<?php

use Danzabar\CLI\CommandTester;

/**
 * The test case to check that the Command tester is fully operational
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class CommandTesterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Command tester;
     *
     * @var Object
     */
    protected $CT;

    /**
     * Set up test vars
     *
     * @return void
     * @author Dan Cox
     */
    public function setUp()
    {
        $this->CT = new CommandTester;
        $this->CT->add(new UtilityTask);
    }

    /**
     * Test basic usage of the command tester
     *
     * @return void
     * @author Dan Cox
     */
    public function test_basic()
    {
        $this->CT->execute('utility:main');

        $this->assertContains('The main action', $this->CT->getOutput());
        $this->assertInstanceOf('\Danzabar\CLI\Application', $this->CT->getApplication());
        $this->assertInstanceOf('\UtilityTask', $this->CT->getTask());
    }

    /**
     * Test the command setter and getter
     *
     * @return void
     * @author Dan Cox
     */
    public function test_CommandSetGet()
    {
        $tester = new CommandTester;

        $tester->setCommand('Utility:main');
        $command1 = $tester->getCommand();

        $tester->setCommand('Fake:main');
        $command2 = $tester->getCommand();

        $this->assertEquals('Utility:main', $command1);
        $this->assertEquals('Fake:main', $command2);
    }
} // END class CommandTesterTest extends \PHPUnit_Framework_TestCase
