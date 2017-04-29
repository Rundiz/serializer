<?php


require __DIR__.'/Autoload.php';

$Autoload = new \Rundiz\Serializer\Tests\Autoload();
$Autoload->addNamespace('Rundiz\\Serializer\\Tests', __DIR__);
$Autoload->addNamespace('Rundiz\\Serializer', dirname(dirname(__DIR__)).'/Rundiz/Serializer');
$Autoload->register();