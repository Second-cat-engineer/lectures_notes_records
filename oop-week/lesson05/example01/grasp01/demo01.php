<?php

/** @var O $o */

if ($o->s == 1 || ($o->s == 2 && $o->d > time() + 3600 * 24)) {

    echo 'button';
}

class O
{
    public $s;
    public $d;
}