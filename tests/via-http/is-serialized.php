<?php
/** 
 * Test check if string is serialized.
 */

require __DIR__ . DIRECTORY_SEPARATOR . '.common-types.php';


if (!class_exists('\\Rundiz\\Serializer\\Serializer')) {
    require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'Rundiz'.DIRECTORY_SEPARATOR.'Serializer'.DIRECTORY_SEPARATOR.'Serializer.php';
}
if (!class_exists('\\Rundiz\\Serializer\\SerializerStatic')) {
    require dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'Rundiz'.DIRECTORY_SEPARATOR.'Serializer'.DIRECTORY_SEPARATOR.'SerializerStatic.php';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Is Serialized test</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Is Serialized?</h1>
        <h3>Check for raw PHP data types</h3>
        <?php
        $Serializer = new Rundiz\Serializer\Serializer();

        for ($i = 1; $i <= 14; $i++) {
            echo '<div class="each-value">' . PHP_EOL;
            echo '<code>$var_' . $i . '</code> = ';
            echo '<pre class="code-value">' . var_export(${'var_' . $i}, true) . '</pre>' . PHP_EOL;
            $isSerialized = $Serializer->isSerialized(${'var_' . $i});
            echo 'is serialized: <code class="' . (false === $isSerialized ? 'expected-result' : 'unexpected-result') . '">' . var_export($isSerialized, true) . '</code>';
            echo PHP_EOL;
            unset($isSerialized);
            echo '</div>' . PHP_EOL;
        }// endfor;
        unset($i);
        ?> 

        <hr>
        <h3>Check for valid AND invalid values</h3>

        <?php
        for ($i = 1; $i <= 15; $i++) {
            echo '<div class="each-value">' . PHP_EOL;
            echo '<code>$varslr_' . $i . '</code> = ';
            echo '<pre class="code-value">' . var_export(${'varslr_' . $i}, true) . '</pre>' . PHP_EOL;
            $isSerialized = $Serializer->isSerialized(${'varslr_' . $i});
            echo 'is serialized: <code class="' . (true === $isSerialized ? 'expected-result' : 'unexpected-result') . '">' . var_export($isSerialized, true) . '</code>';
            echo PHP_EOL;
            unset($isSerialized);
            echo '</div>' . PHP_EOL;
        }// endfor;
        unset($i);

        unset($Serializer);
        ?> 

        <hr>
        <h3>Check is serialized using static method</h3>

        <?php
        for ($i = 1; $i <= 15; $i++) {
            echo '<div class="each-value">' . PHP_EOL;
            echo '<code>$varslr_' . $i . '</code> = ';
            echo '<pre class="code-value">' . var_export(${'varslr_' . $i}, true) . '</pre>' . PHP_EOL;
            $isSerialized = \Rundiz\Serializer\SerializerStatic::isSerialized(${'varslr_' . $i});
            echo 'is serialized: <code class="' . (true === $isSerialized ? 'expected-result' : 'unexpected-result') . '">' . var_export($isSerialized, true) . '</code>';
            echo PHP_EOL;
            unset($isSerialized);
            echo '</div>' . PHP_EOL;
        }// endfor;
        unset($i);
        ?>
    </body>
</html>
