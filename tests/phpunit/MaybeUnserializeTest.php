<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer\Tests;

class MaybeUnserializeTest extends \PHPUnit\Framework\TestCase
{


    public function testUnserialized()
    {
        $raw_array = array('zero key', 'a' => 'a key', 'aa' => array('multi', 'dimension', 'array' => 'key', 'lang' => 'ภาษาไทย'));
        $serialized_array = 'a:3:{i:0;s:8:"zero key";s:1:"a";s:5:"a key";s:2:"aa";a:4:{i:0;s:5:"multi";i:1;s:9:"dimension";s:5:"array";s:3:"key";s:4:"lang";s:21:"ภาษาไทย";}}';

        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertSame($Serializer->maybeUnserialize($raw_array), $raw_array);
        $this->assertSame(\Rundiz\Serializer\SerializerStatic::maybeUnserialize($raw_array), $raw_array);
    }// testUnserialized


    public function testSerialized()
    {
        $raw_array = array('zero key', 'a' => 'a key', 'aa' => array('multi', 'dimension', 'array' => 'key', 'lang' => 'ภาษาไทย'));
        $serialized_array = 'a:3:{i:0;s:8:"zero key";s:1:"a";s:5:"a key";s:2:"aa";a:4:{i:0;s:5:"multi";i:1;s:9:"dimension";s:5:"array";s:3:"key";s:4:"lang";s:21:"ภาษาไทย";}}';

        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertSame($Serializer->maybeUnserialize($serialized_array), $raw_array);
        $this->assertSame(\Rundiz\Serializer\SerializerStatic::maybeUnserialize($serialized_array), $raw_array);
    }// testSerialized


}