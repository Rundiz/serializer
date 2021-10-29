<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer\Tests;

class IsBase64EncodedTest extends \PHPUnit\Framework\TestCase
{


    public function testBase64EncodedBoolean()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertFalse($Serializer->isBase64Encoded(true));
        $this->assertFalse($Serializer->isBase64Encoded(false));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded(true));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded(false));
    }// testBase64EncodedBoolean


    public function testBase64EncodedInteger()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertFalse($Serializer->isBase64Encoded(12345));
        $this->assertFalse($Serializer->isBase64Encoded(012345));
        $this->assertFalse($Serializer->isBase64Encoded(555));
        $this->assertFalse($Serializer->isBase64Encoded(5555));
        $this->assertFalse($Serializer->isBase64Encoded('12345'));
        $this->assertTrue($Serializer->isBase64Encoded('NTU1NQ=='));// it is base 64 encoded for '5555'
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded('12345'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isBase64Encoded('NTU1NQ=='));
    }// testBase64EncodedInteger


    public function testBase64EncodedDouble()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertFalse($Serializer->isBase64Encoded('2345.67'));
        $this->assertFalse($Serializer->isBase64Encoded('-2345.67'));
        $this->assertFalse($Serializer->isBase64Encoded(2345.67));
        $this->assertFalse($Serializer->isBase64Encoded(-2345.67));
        $this->assertTrue($Serializer->isBase64Encoded('MjM0NS42Nw=='));// it is base 64 encoded for 2345.67
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isBase64Encoded('MjM0NS42Nw=='));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded('23456.78'));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded('-23456.78'));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded(23456.78));
    }// testBase64EncodedDouble


    public function testBase64EncodedString()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertFalse($Serializer->isBase64Encoded('test'));
        $this->assertFalse($Serializer->isBase64Encoded('สวัสดี'));
        $this->assertFalse($Serializer->isBase64Encoded('hello'));
        $this->assertFalse($Serializer->isBase64Encoded('"hello"'));
        $this->assertTrue($Serializer->isBase64Encoded('aGVsbG8='));// valid base 64 encoded for 'hello'
        $this->assertTrue($Serializer->isBase64Encoded('4Liq4Lin4Lix4Liq4LiU4Li1'));// valid base 64 encoded for 'สวัสดี'
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isBase64Encoded('dGVzdA=='));// valid base 64 encoded for 'test'
        $this->assertTrue($Serializer->isBase64Encoded(''));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isBase64Encoded(''));
    }// testBase64EncodedString


    public function testBase64EncodedArray()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertFalse($Serializer->isBase64Encoded(['a' => 'b']));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded(['a' => 'b']));
    }// testBase64EncodedArray


    public function testBase64EncodedObject()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $std = new \stdClass();
        $std->name = 'My Name';
        $this->assertFalse($Serializer->isBase64Encoded($std));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded($std));
    }// testBase64EncodedObject


    public function testBase64EncodedNull()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertFalse($Serializer->isBase64Encoded('null'));
        $this->assertFalse($Serializer->isBase64Encoded(null));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded('null'));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isBase64Encoded(null));
    }// testBase64EncodedNull


}