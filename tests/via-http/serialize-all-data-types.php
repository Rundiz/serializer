<?php
/** 
 * Test serialize all data types in common-types.php
 */

require __DIR__ . DIRECTORY_SEPARATOR . 'common-types.php';


if (!class_exists('\\Rundiz\\Serializer\\Serializer')) {
    require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'Rundiz'.DIRECTORY_SEPARATOR.'Serializer'.DIRECTORY_SEPARATOR.'Serializer.php';
}


$Serializer = new Rundiz\Serializer\Serializer();

echo '<meta charset="utf-8">'."\n";
for ($i = 1; $i <= 13; $i++) {
    echo '$var_'.$i.' = <pre style="background-color: #222; color: grey; margin: 0; padding: 5px;">'.var_export(${'var_'.$i}, true).'</pre>';
    echo '<span style="color: red;">'.gettype(${'var_'.$i}).'</span>';
    echo "<br>\n";
    echo 'serialized = <span style="color: green;">'.htmlspecialchars($Serializer->maybeSerialize(${'var_'.$i}), ENT_QUOTES).'</span>';
    echo '<br style="clear: both; margin-bottom: 60px;">'."\n";
}


/*echo '<hr>';


echo 'Strings below is for use with test unserialize and serialized check.<br>';
for ($i = 1; $i <= 13; $i++) {
    echo '$varslr_'.$i.' = \''.htmlspecialchars(serialize(${'var_'.$i}), ENT_QUOTES).'\';<br>'."\n";
}*/

unset($Serializer);