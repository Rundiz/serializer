<?php
/**
 * Declare all of PHP data types for common tests.
 * 
 * @link http://php.net/manual/en/function.gettype.php Reference.
 * @link http://php.net/manual/en/language.types.intro.php Reference.
 * @link http://php.net/manual/en/function.serialize.php Reference.
 * 
 * Available types:
 * boolean, integer, float (double), string, array, object, resource, NULL, unknown type
 */


// raw data types
$var_1 = true;
$var_2 = 1213;
$var_3 = -5436;
$var_4 = -9843214132123123123123132;// becomes double or float.
$var_5 = 12312398908085743843652340983;// becomes double or float.
$var_6 = floatval('123.45');
$var_7 = floatval('-9871354654687987156123.32');
$var_8 = floatval('12312495467032489798424.56');
$var_9 = 'this is a string. สตริงภาษาไทย';
$var_10 = array('zero key', 'a' => 'a key', 'aa' => array('multi', 'dimension', 'array' => 'key', 'lang' => 'ภาษาไทย'));
$var_11 = new \stdClass();
$var_11->property1 = 'Property 1';
$var_11->property2 = 'พร็อพเพอร์ตี้ 2';
$var_12 = fopen(__FILE__, 'r');
$var_13 = null;
$var_14 = new \stdClass();
$var_14->propertyBoolean = false;
$var_14->propertyInteger = $var_2;
$var_14->propertyFloat = $var_3;
$var_14->propertyString = $var_4;
$var_14->propertyArray = $var_5;
$var_14->propertyObj = new \stdClass();
$var_14->propertyResource = $var_7;
$var_14->propertyNull = $var_8;
$var_14->propertySerialized = 'O:8:"stdClass":2:{s:9:"property1";s:10:"Property 1";s:9:"property2";s:41:"พร็อพเพอร์ตี้ 2";}';


// serialized strings
$varslr_1 = 'b:1;';
$varslr_2 = 'i:1213;';
$varslr_3 = 'i:-5436;';
$varslr_4 = 'd:-9.8432141321231232E+24;';
$varslr_5 = 'd:1.2312398908085743E+28;';
$varslr_6 = 'd:123.45;';
$varslr_7 = 'd:-9.871354654687987E+21;';
$varslr_8 = 'd:1.231249546703249E+22;';
$varslr_9 = 's:54:"this is a string. สตริงภาษาไทย";';
$varslr_10 = 'a:3:{i:0;s:8:"zero key";s:1:"a";s:5:"a key";s:2:"aa";a:4:{i:0;s:5:"multi";i:1;s:9:"dimension";s:5:"array";s:3:"key";s:4:"lang";s:21:"ภาษาไทย";}}';
$varslr_11 = 'O:8:"stdClass":2:{s:9:"property1";s:10:"Property 1";s:9:"property2";s:41:"พร็อพเพอร์ตี้ 2";}';
$varslr_12 = 'i:0;';
$varslr_13 = 'N;';
$varslr_14 = 'O:8:"stdClass":9:{s:15:"propertyBoolean";b:0;s:15:"propertyInteger";i:1213;s:13:"propertyFloat";d:-9.8432141321231232E+24;s:14:"propertyString";d:1.2312398908085743E+28;s:13:"propertyArray";d:123.45;s:11:"propertyObj";O:8:"stdClass":0:{}s:16:"propertyResource";d:1.231249546703249E+22;s:12:"propertyNull";s:54:"this is a string. สตริงภาษาไทย";s:18:"propertySerialized";s:118:"O:8:"stdClass":2:{s:9:"property1";s:10:"Property 1";s:9:"property2";s:41:"พร็อพเพอร์ตี้ 2";}";}';
$varslr_15 = 's:12:"fake serialized string";';