<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer\Tests;

class IsSerializedTest extends \PHPUnit\Framework\TestCase
{


    public function testSerializedBoolean()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isSerialized('b:1;'));
        $this->assertTrue($Serializer->isSerialized('b:0;'));
        $this->assertFalse($Serializer->isSerialized('b:2;'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('b:1;'));
    }// testSerializedBoolean


    public function testSerializedInteger()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isSerialized('i:1213;'));
        $this->assertTrue($Serializer->isSerialized('i:-5436;'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('i:1234567890123456;'));
        $this->assertFalse($Serializer->isSerialized('i:1213.45;'));
    }// testSerializedInteger


    public function testSerializedDouble()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isSerialized('d:123.45;'));
        $this->assertTrue($Serializer->isSerialized('d:998765;'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('d:-9.871354654687987E+21;'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('d:1.231249546703249E+22;'));
    }// testSerializedDouble


    public function testSerializedString()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isSerialized('s:54:"this is a string. สตริงภาษาไทย";'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('s:54:"this is a string. สตริงภาษาไทย";'));
        $this->assertFalse($Serializer->isSerialized('s:12:"fake serialized string";'));
        $this->assertFalse(\Rundiz\Serializer\SerializerStatic::isSerialized('s:12:"fake serialized string";'));
    }// testSerializedString


    public function testSerializedArray()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isSerialized('a:3:{i:0;s:8:"zero key";s:1:"a";s:5:"a key";s:2:"aa";a:4:{i:0;s:5:"multi";i:1;s:9:"dimension";s:5:"array";s:3:"key";s:4:"lang";s:21:"ภาษาไทย";}}'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('a:3:{i:0;s:8:"zero key";s:1:"a";s:5:"a key";s:2:"aa";a:4:{i:0;s:5:"multi";i:1;s:9:"dimension";s:5:"array";s:3:"key";s:4:"lang";s:21:"ภาษาไทย";}}'));
    }// testSerializedArray


    public function testSerializedObject()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isSerialized('O:8:"stdClass":2:{s:9:"property1";s:10:"Property 1";s:9:"property2";s:41:"พร็อพเพอร์ตี้ 2";}'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('O:8:"stdClass":2:{s:9:"property1";s:10:"Property 1";s:9:"property2";s:41:"พร็อพเพอร์ตี้ 2";}'));
    }// testSerializedObject


    public function testSerializedNull()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertTrue($Serializer->isSerialized('N;'));
        $this->assertFalse($Serializer->isSerialized('N:3;'));
        $this->assertTrue(\Rundiz\Serializer\SerializerStatic::isSerialized('N;'));
    }// testSerializedNull


}