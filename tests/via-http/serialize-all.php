<?php
/** 
 * Test serialize all data types in .common-types.php
 */

require __DIR__ . DIRECTORY_SEPARATOR . '.common-types.php';


if (!class_exists('\\Rundiz\\Serializer\\Serializer')) {
    require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'Rundiz'.DIRECTORY_SEPARATOR.'Serializer'.DIRECTORY_SEPARATOR.'Serializer.php';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Serialize all</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Serialize all items</h1>
        <?php
        $Serializer = new Rundiz\Serializer\Serializer();

        for ($i = 1; $i <= 14; $i++) {
            echo '<div class="each-value">' . PHP_EOL;
            echo '<code>$var_' . $i . '</code> = ';
            echo '<pre class="code-value">' . var_export(${'var_' . $i}, true) . '</pre>' . PHP_EOL;
            $serialized = $Serializer->maybeSerialize(${'var_' . $i});
            echo 'serialized: <pre class="code-result">' . var_export($serialized, true) . '</pre>';
            echo PHP_EOL;
            unset($serialized);
            echo '</div>' . PHP_EOL;
        }// endfor;
        unset($i);

        unset($Serializer);
        ?> 
    </body>
</html>