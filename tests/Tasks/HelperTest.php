<?php

use Danzabar\CLI\Tasks\Helpers;
use Danzabar\CLI\Output\Output;
use Danzabar\CLI\Input\Input;
use Phalcon\DI;

/**
 * Test case for the helper class
 *
 * @package CLI
 * @subpackage Tests\Tasks
 * @author Dan Cox
 */
class HelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Instance of the helper class
     *
     * @var Object
     */
    protected $helpers;

    /**
     * Set up test vars
     *
     * @return void
     * @author Dan Cox
     */
    public function setUp()
    {
        $di = new DI;
        $di->setShared('output', new Output);
        $di->setShared('input', new Input);

        $this->helpers = new Helpers($di);
    }

    /**
     * Test registering and getting helper
     *
     * @return void
     * @author Dan Cox
     */
    public function test_registerAndGetHelper()
    {
        $this->helpers->registerHelper('utility.question', 'ClassName');

        $this->assertEquals('ClassName', $this->helpers->getRegisteredHelper('utility.question'));
    }

    /**
     * Test a real case of loading a helpe
     *
     * @return void
     * @author Dan Cox
     */
    public function test_registerRealHelperReturnRealValues()
    {
        $this->helpers->registerHelper('question', 'Danzabar\CLI\Tasks\Helpers\Question');
        $q = $this->helpers->load('question');

        $this->assertInstanceOf('Phalcon\DI', $q->getDI());
    }

    /**
     * Test that the helpers throw an exception when it cant find the helper
     *
     * @return void
     * @author Dan Cox
     */
    public function test_throwexceptionOnUnknownHelper()
    {
        $this->setExpectedException('Danzabar\CLI\Tasks\Exceptions\RegisteredHelperClassNotFoundException');

        $this->helpers->load('unknown');
    }
} // END class HelperTest extends \PHPUnit_Framework_TestCase
