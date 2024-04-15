<?php
/** 
 * Test unserialize all $varslr_ in .common-types.php.
 */

require __DIR__ . DIRECTORY_SEPARATOR . '.common-types.php';


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Unserialize all</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Unserialize all items</h1>
        <?php
        for ($i = 1; $i <= 15; $i++) {
            echo '<div class="each-value">' . PHP_EOL;
            echo '<code>$varslr_' . $i . '</code> = ';
            echo '<pre class="code-value">' . var_export(${'varslr_' . $i}, true) . '</pre>' . PHP_EOL;
            $unSerialized = @unserialize(${'varslr_' . $i});
            echo 'unserialized: <code class="code-result' . (false === $unSerialized ? ' unexpected-result' : '') . '">' . var_export($unSerialized, true) . '</code>';
            echo PHP_EOL;
            unset($unSerialized);
            echo '</div>' . PHP_EOL;
        }// endfor;
        unset($i);
        ?> 
    </body>
</html>