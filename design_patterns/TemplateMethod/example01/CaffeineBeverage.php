<?php

namespace TemplateMethod\example01;

abstract class CaffeineBeverage
{
    final public function prepareRecipe()
    {
        $this->boilWater();
        $this->brew();
        $this->pourInCup();

        if ($this->hook()) {
            $this->addCondiments();
        }
    }

    abstract protected function brew();

    abstract protected function addCondiments();

    protected function boilWater()
    {
        echo 'Boiling water'.PHP_EOL;
    }

    protected function pourInCup()
    {
        echo 'Pouring into cup'.PHP_EOL;
    }

    protected function hook()
    {
        return true;
        // Наследники могут переопределять эти методы (перехватчики), но не обязаны это делать.
    }
}