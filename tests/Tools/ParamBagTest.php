<?php

use Danzabar\CLI\Tools\ParamBag;

/**
 * Test case for the param bag class
 *
 * @package CLI
 * @subpackage Tests\Tools
 * @author Dan Cox
 */
class ParamBagTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * Instance of the param bag class
     *
     * @var Object
     */
    protected $params;

    /**
     * Set up test vars
     *
     * @return void
     * @author Dan Cox
     */
    public function setUp()
    {
        $this->params = new ParamBag;
    }

    /**
     * Tear down test vars
     *
     * @return void
     * @author Dan Cox
     */
    public function tearDown()
    {
        $this->params->clear();
    }

    /**
     * Basic add and get test
     *
     * @return void
     * @author Dan Cox
     */
    public function test_addgetparams()
    {
        $this->params->var1 = 'value';
        $this->params->test = 'foo';

        $this->assertEquals('value', $this->params->var1);
        $this->assertEquals('foo', $this->params->test);
        $this->assertFalse($this->params->fake);
    }

    /**
     * Bulk loading vars
     *
     * @return void
     * @author Dan Cox
     */
    public function test_bulkLoad()
    {
        $this->params->load(array(
            'bar'   => 'foo',
            'test'  => 'value'
        ));

        $this->assertTrue(isset($this->params->bar));
        $this->assertTrue(isset($this->params->test));
        $this->assertEquals('foo', $this->params->bar);
        $this->assertEquals('value', $this->params->test);

        $this->assertEquals(
            array('bar' => 'foo', 'test' => 'value'),
            $this->params->all()
        );
    }

    /**
     * Test removing single values and clearing all
     *
     * @return void
     * @author Dan Cox
     */
    public function test_clearAndUnset()
    {
        $this->params->test = 'value';
        $this->assertTrue(isset($this->params->test));

        unset($this->params->test);
        $this->assertFalse(isset($this->params->test));

        $this->params->test = 'value';
        $this->assertTrue(isset($this->params->test));
        
        $this->params->clear();
        $this->assertFalse(isset($this->params->test));
    }
} // END class ParamBagTest extends \PHPUnit_Framework_TestCase
