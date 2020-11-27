<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer\Tests;

class MaybeSerializeTest extends \PHPUnit\Framework\TestCase
{


    public function testUnserialized()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertSame($Serializer->maybeSerialize('this is a string. สตริงภาษาไทย'), 's:54:"this is a string. สตริงภาษาไทย";');
        $this->assertSame(\Rundiz\Serializer\SerializerStatic::maybeSerialize('this is a string. สตริงภาษาไทย'), 's:54:"this is a string. สตริงภาษาไทย";');
    }// testUnserialized


    public function testSerialized()
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        $this->assertSame($Serializer->maybeSerialize('s:54:"this is a string. สตริงภาษาไทย";'), 's:54:"this is a string. สตริงภาษาไทย";');
        $this->assertSame(\Rundiz\Serializer\SerializerStatic::maybeSerialize('s:54:"this is a string. สตริงภาษาไทย";'), 's:54:"this is a string. สตริงภาษาไทย";');
    }// testSerialized


}