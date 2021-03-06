<?php
/**
 * @package wsdl2phpTest
 */

/**
 * Test class for Validator.
 * Generated by PHPUnit on 2009-11-11 at 00:56:02.
 *
 * @package wsdl2phpTest
 */
class ValidatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Wsdl2PhpValidator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = null;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * Testing the validate class function
     */
    public function testValidateClass()
    {
        $this->assertEquals('foo', Validator::validateClass('foo'));
        $this->assertEquals('foobar', Validator::validateClass('foo-bar'));
        $this->assertEquals('Foo', Validator::validateClass('Foo'));
        $this->assertEquals('foo523', Validator::validateClass('foo523'));

        $this->setExpectedException('ValidationException');
        Validator::validateClass('SoapClient');

        $this->setExpectedException('ValidationException');
        $this->assertEquals('for', Validator::validateClass('for')); // for is reserved keyword
    }

    /**
     * Testing the validate class function with a reserved keyword
     */
    public function testValidateClassReservedKeyword()
    {
        $this->setExpectedException('ValidationException');
        $this->assertEquals('for', Validator::validateClass('for')); // for is reserved keyword
        $this->assertEquals('List', Validator::validateClass('List')); // for is reserved keyword
    }

    /**
     * Testing the validate class function with another reserved keyword
     */
    public function testValidateClassReservedKeyword2()
    {
        $this->setExpectedException('ValidationException');
        $this->assertEquals('List', Validator::validateClass('List')); // list is reserved keyword. PHP is not case sensitive in keywords
    }

    /**
     * Test the typename
     */
    public function testValidateType()
    {
        $this->assertEquals('foo', Validator::validateType('foo'));
        $this->assertEquals('foobar', Validator::validateType('foo-bar'));
        $this->assertEquals('Foo', Validator::validateType('Foo'));
        $this->assertEquals('foo523', Validator::validateType('foo523'));
        $this->assertEquals('_test[]', Validator::validateType('arrayOf_test'));
        $this->assertEquals('Test[]', Validator::validateType('arrayOfTest'));
        $this->assertEquals('test[]', Validator::validateType('test[]'));
        $this->assertEquals('_xsd_int[]', Validator::validateType('ArrayOf_xsd_int'));

        $this->assertEquals('int', Validator::validateType('nonNegativeInteger'));
        $this->assertEquals('float', Validator::validateType('float'));
        $this->assertEquals('string', Validator::validateType('normalizedString'));
        $this->assertEquals('Foo[]', Validator::validateType('ArrayOfFoo'));
        $this->assertEquals('Foo[]', Validator::validateType('Foo[]'));

        $this->setExpectedException('ValidationException');
        $this->assertEquals('and', Validator::validateType('and')); // and is reserved keyword
    }

    /**
     * test the name
     */
    public function testValidateNamingConvention()
    {
        $this->assertEquals('foo', Validator::validateNamingConvention('foo'));
        $this->assertEquals('foobar', Validator::validateNamingConvention('foo-bar'));
        $this->assertEquals('Foo', Validator::validateNamingConvention('Foo'));
        $this->assertEquals('foo523', Validator::validateNamingConvention('foo523'));
        $this->assertEquals('a123foo', Validator::validateNamingConvention('123foo'));
        $this->assertEquals('a123foo123', Validator::validateNamingConvention('123foo$123'));
        $this->assertEquals('a123foo', Validator::validateNamingConvention('123f|o|o'));
    }
}
