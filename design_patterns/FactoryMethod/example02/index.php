<?php

use FactoryMethod\example02\Creator;
use FactoryMethod\example02\Creator\Creator1;
use FactoryMethod\example02\Creator\Creator2;

require_once __DIR__ . '/../../autoload.php';

function clientCode(Creator $creator)
{
    // ...
    echo "Client: I'm not aware of the creator's class, but it still works.\n"
        . $creator->someOperation();
    // ...
}

echo "App: Launched with the Concrete Creator1.\n";
clientCode(new Creator1());
echo "\n\n";

echo "App: Launched with the Concrete Creator2.\n";
clientCode(new Creator2());