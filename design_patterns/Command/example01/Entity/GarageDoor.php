<?php

namespace Command\example01\Entity;

class GarageDoor
{
    public function up()
    {
        echo 'Garage Door Open'.PHP_EOL;
    }

    public function down()
    {
        echo 'Garage Door Close'.PHP_EOL;
    }

    public function stop()
    {
        echo 'Garage Door stop'.PHP_EOL;
    }

    public function lightOn()
    {
        echo 'Garage Door light on'.PHP_EOL;
    }

    public function lightOff()
    {
        echo 'Garage Door light off'.PHP_EOL;
    }
}