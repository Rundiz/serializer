<?php
/** 
 * Test check if string is serialized.
 */

require __DIR__ . DIRECTORY_SEPARATOR . 'common-types.php';


if (!class_exists('\\Rundiz\\Serializer\\Serializer')) {
    require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'Rundiz'.DIRECTORY_SEPARATOR.'Serializer'.DIRECTORY_SEPARATOR.'Serializer.php';
}
if (!class_exists('\\Rundiz\\Serializer\\SerializerStatic')) {
    require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'Rundiz'.DIRECTORY_SEPARATOR.'Serializer'.DIRECTORY_SEPARATOR.'SerializerStatic.php';
}


$Serializer = new Rundiz\Serializer\Serializer();

echo '<meta charset="utf-8">'."\n";
echo '<h2>Check is serialized for raw PHP data types</h2>'."\n";
for ($i = 1; $i <= 13; $i++) {
    echo '$var_'.$i.' = <pre style="background-color: #222; color: grey; margin: 0; padding: 5px;">'.var_export(${'var_'.$i}, true).'</pre>';
    echo '<span style="color: red;">'.gettype(${'var_'.$i}).'</span>';
    echo "<br>\n";
    if ($Serializer->isSerialized(${'var_'.$i}) === true) {
        $is_serialized = 'true';
    } elseif ($Serializer->isSerialized(${'var_'.$i}) === false) {
        $is_serialized = 'false';
    } else {
        $is_serialized = $Serializer->isSerialized(${'var_'.$i});
    }
    echo 'is serialized = <span style="color: green;">'.htmlspecialchars($is_serialized, ENT_QUOTES).'</span>';
    echo '<br style="clear: both; margin-bottom: 60px;">'."\n";
}


echo '<hr>'."\n";
echo '<h2>Check is serialized for serialized string and fake serialized string</h2>'."\n";
for ($i = 1; $i <= 14; $i++) {
    echo '$var_'.$i.' = <pre style="background-color: #222; color: grey; margin: 0; padding: 5px;">'.var_export(${'varslr_'.$i}, true).'</pre>';
    echo '<span style="color: red;">'.gettype(${'varslr_'.$i}).'</span>';
    echo "<br>\n";
    if ($Serializer->isSerialized(${'varslr_'.$i}) === true) {
        $is_serialized = 'true';
    } elseif ($Serializer->isSerialized(${'varslr_'.$i}) === false) {
        $is_serialized = 'false';
    } else {
        $is_serialized = $Serializer->isSerialized(${'varslr_'.$i});
    }
    echo 'is serialized = <span style="color: green;">'.htmlspecialchars($is_serialized, ENT_QUOTES).'</span>';
    echo '<br style="clear: both; margin-bottom: 60px;">'."\n";
}

unset($Serializer);


echo '<hr>'."\n";
echo '<h2>Check is serialized by using static method</h2>'."\n";
for ($i = 1; $i <= 14; $i++) {
    echo '$var_'.$i.' = <pre style="background-color: #222; color: grey; margin: 0; padding: 5px;">'.var_export(${'varslr_'.$i}, true).'</pre>';
    echo '<span style="color: red;">'.gettype(${'varslr_'.$i}).'</span>';
    echo "<br>\n";
    if (\Rundiz\Serializer\SerializerStatic::isSerialized(${'varslr_'.$i}) === true) {
        $is_serialized = 'true';
    } elseif (\Rundiz\Serializer\SerializerStatic::isSerialized(${'varslr_'.$i}) === false) {
        $is_serialized = 'false';
    } else {
        $is_serialized = \Rundiz\Serializer\SerializerStatic::isSerialized(${'varslr_'.$i});
    }
    echo 'is serialized = <span style="color: green;">'.htmlspecialchars($is_serialized, ENT_QUOTES).'</span>';
    echo '<br style="clear: both; margin-bottom: 60px;">'."\n";
}