<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer\Tests;

class IsJSONEncodedTest extends \PHPUnit\Framework\TestCase
{


    public function testJSONEncodedBoolean()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isJSONEncoded('true'));
        $this->assertTrue($Serializer->isJSONEncoded('false'));
        $this->assertTrue($Serializer->isJSONEncoded(true));
        $this->assertFalse($Serializer->isJSONEncoded(false));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('true'));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isJSONEncoded(false));
    }// testJSONEncodedBoolean


    public function testJSONEncodedInteger()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isJSONEncoded(12345));
        $this->assertTrue($Serializer->isJSONEncoded(012345));
        $this->assertTrue($Serializer->isJSONEncoded('12345'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('12345'));
        $this->assertFalse($Serializer->isJSONEncoded('012345'));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('012345'));
    }// testJSONEncodedInteger


    public function testJSONEncodedDouble()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isJSONEncoded('2345.67'));
        $this->assertTrue($Serializer->isJSONEncoded('-2345.67'));
        $this->assertTrue($Serializer->isJSONEncoded(2345.67));
        $this->assertTrue($Serializer->isJSONEncoded(-2345.67));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('2345.67'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('-23456.78'));
    }// testJSONEncodedDouble


    public function testJSONEncodedString()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertFalse($Serializer->isJSONEncoded('this is a string. สตริงภาษาไทย'));
        $this->assertTrue($Serializer->isJSONEncoded('"this is a string. สตริงภาษาไทย"'));
        $this->assertTrue($Serializer->isJSONEncoded('"Hello world"'));
        $this->assertFalse($Serializer->isJSONEncoded('0123456'));
        $this->assertTrue($Serializer->isJSONEncoded('"0123456"'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('"this is a string. สตริงภาษาไทย"'));
        $this->assertFalse($Serializer->isJSONEncoded(''));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isJSONEncoded(''));
    }// testJSONEncodedString


    public function testJSONEncodedArray()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isJSONEncoded('[0,"one",2.2222,[3]]'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('[0,"one",2.2222,[3]]'));
    }// testJSONEncodedArray


    public function testJSONEncodedObject()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isJSONEncoded('{"0":"zero key","a":"a key","aa":{"0":"multi","1":"dimension","array":"key","lang":"\u0e20\u0e32\u0e29\u0e32\u0e44\u0e17\u0e22"}}'));// array but json encoded as object.
        $this->assertTrue($Serializer->isJSONEncoded('{"property1":"Property 1","property2":"\u0e1e\u0e23\u0e47\u0e2d\u0e1e\u0e40\u0e1e\u0e2d\u0e23\u0e4c\u0e15\u0e35\u0e49 2"}'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('{"property1":"Property 1","property2":"\u0e1e\u0e23\u0e47\u0e2d\u0e1e\u0e40\u0e1e\u0e2d\u0e23\u0e4c\u0e15\u0e35\u0e49 2"}'));
    }// testJSONEncodedObject


    public function testJSONEncodedNull()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isJSONEncoded('null'));
        $this->assertFalse($Serializer->isJSONEncoded(null));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isJSONEncoded('null'));
    }// testJSONEncodedNull


}