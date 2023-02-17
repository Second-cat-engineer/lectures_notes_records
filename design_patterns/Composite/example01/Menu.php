<?php

namespace Composite\example01;

class Menu extends MenuComponent
{
    /** @var MenuComponent[]  */
    protected array $menuComponents = [];
    protected string $name;
    protected string $description;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function add(MenuComponent $menuComponent)
    {
        $this->menuComponents[] = $menuComponent;
    }

    public function remove(MenuComponent $menuComponent)
    {
//        unset($this->menuComponents[$menuComponent->getName()]);
    }

    public function getChild(int $id)
    {
        return $this->menuComponents[$id];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function print()
    {
        echo $this->getName() .', '.$this->description.PHP_EOL.'__________________'.PHP_EOL;

        foreach ($this->menuComponents as $menuComponent) {
            $menuComponent->print();
        }

        echo '__________________'.PHP_EOL;
    }
}