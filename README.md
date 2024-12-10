# Serializer Component

The Serializer classes provide functional with serialization such as check if string is serialized, maybe serialize, maybe unserialize, or is JSON encoded (valid JSON) for prevent double serialization.
This Serializer also supported unicode text.

[![Latest Stable Version](https://poser.pugx.org/rundiz/serializer/v/stable)](https://packagist.org/packages/rundiz/serializer)
[![License](https://poser.pugx.org/rundiz/serializer/license)](https://packagist.org/packages/rundiz/serializer)
[![Total Downloads](https://poser.pugx.org/rundiz/serializer/downloads)](https://packagist.org/packages/rundiz/serializer)

Tested up to PHP 8.4.

## Example:

### Check if string is serialized:

```php
$Serializer = new \Rundiz\Serializer\Serializer();

$serialized_string = 's:54:"this is a string. สตริงภาษาไทย";';
$faked_serialized_string = 's:12:"fake serialized string";';

var_dump($Serializer->isSerialized($serialized_string);// true
var_dump($Serializer->isSerialized($faked_serialized_string);// false
```

Or you can use static methods from `\Rundiz\Serializer\SerializerStatic` class with the same method as `\Rundiz\Serializer\Serializer` class.

```php
$serialized_string = 's:54:"this is a string. สตริงภาษาไทย";';

var_dump(\Rundiz\Serializer\SerializerStatic::isSerialized($serialized_string));// true
```

### Check first if data is not serialized then serialize it:

```php
$raw_data = array('mango', 'tree' => array('mango', 'banana'));

echo $Serializer->maybeSerialize($raw_data);// a:2:{i:0;s:5:"mango";s:4:"tree";a:2:{i:0;s:5:"mango";i:1;s:6:"banana";}}
echo \Rundiz\Serializer\SerializerStatic::maybeSerialize($raw_data);// a:2:{i:0;s:5:"mango";s:4:"tree";a:2:{i:0;s:5:"mango";i:1;s:6:"banana";}}
```

### Check first if data is not unserialized then unserialize it:

```php
$serialized_data = 'i:-5436;';

echo $Serializer->maybeUnserialize($serialized_data);// -5436 (integer)
echo \Rundiz\Serializer\SerializerStatic::maybeUnserialize($serialized_data);// -5436 (integer)
echo \Rundiz\Serializer\SerializerStatic::maybeUnserialize(-5436);// -5436 (integer)
```

### Working with JSON:
```php
var_dump($Serializer->isJSONEncoded('"Hello world"'));// true
var_dump($Serializer->isJSONEncoded('012345'));// false
var_dump($Serializer->isJSONEncoded('true'));// true
var_dump($Serializer->isJSONEncoded('false'));// true
var_dump($Serializer->isJSONEncoded('null'));// true
var_dump($Serializer->isJSONEncoded(true));// true
var_dump($Serializer->isJSONEncoded(false));// false
var_dump($Serializer->isJSONEncoded(null));// false
```

### Working with base64:
```php
var_dump($Serializer->isBase64Encoded(5555));// false
var_dump($Serializer->isBase64Encoded('NTU1NQ=='));// true
var_dump($Serializer->isBase64Encoded('test'));// false
var_dump($Serializer->isBase64Encoded('dGVzdA=='));// true
var_dump($Serializer->isBase64Encoded(null));// false
```

---

For more example, please look inside **tests** folder.