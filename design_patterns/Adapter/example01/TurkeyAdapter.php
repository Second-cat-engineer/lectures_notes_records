<?php

namespace Adapter\example01;

class TurkeyAdapter implements DuckInterface
{
    private TurkeyInterface $turkey;

    public function __construct(TurkeyInterface $turkey)
    {
        $this->turkey = $turkey;
    }

    public function quack()
    {
        $this->turkey->gobble();
    }

    public function fly()
    {
        for ($i=1; $i <= 5; $i++) {
            $this->turkey->fly();
        }
    }
}