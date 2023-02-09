<?php

namespace Observer\example01;

interface Observer
{
    public function update(float $temp, float $humidity, float $pressure);
}