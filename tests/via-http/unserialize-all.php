<?php
/** 
 * Test unserialize all $varslr_ in common-types.php.
 */

require __DIR__ . DIRECTORY_SEPARATOR . 'common-types.php';


echo '<meta charset="utf-8">'."\n";
for ($i = 1; $i <= 15; $i++) {
    echo '$varslr_'.$i.' = <span style="color: grey;">'.htmlspecialchars(var_export(${'varslr_'.$i}, true), ENT_QUOTES).';</span>';
    echo '<br>'."\n";
    echo 'unserialize = <pre style="background-color: #222; color: green; margin: 0; padding: 5px;">'.print_r(@unserialize(${'varslr_'.$i}), true).'</pre>';
    echo '<span style="color: red;">'.gettype(@unserialize(${'varslr_'.$i})).'</span>';
    echo '<br style="clear: both; margin-bottom: 60px;">'."\n";
}