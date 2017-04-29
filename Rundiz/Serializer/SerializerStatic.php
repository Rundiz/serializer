<?php
/**
 * Serializer class for use in static method.
 * 
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer;


/**
 * Works with serialize.
 * 
 * @method boolean isSerialized(string $string) Check if string is serialized
 * @method string maybeSerialize(mixed $value) Check first that data is serialized or not, if not then serialize it otherwise return as is.
 */
class SerializerStatic
{


    public static function __callStatic($name, $arguments)
    {
        $Serializer = new \Rundiz\Serializer\Serializer();
        return call_user_func_array([$Serializer, $name], $arguments);
    }// __callStatic


}