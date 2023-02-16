<?php

namespace Iterator\example01;

interface IteratorInterface
{
    public function hasNext(): bool;
    public function next();
}