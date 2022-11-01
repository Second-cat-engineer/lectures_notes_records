<?php
interface Measurable
{
    public function getWidth();
    public function getHeight();
}

interface Movable
{
    public function move($x, $y);
}

interface Visible
{
    public function getPoligons();
    public function getColor();
}

//======================================================================================================================
class Measurer
{
    public function maxSize(Measurable $obj)
    {
        return max($obj->getWidth(), $obj->getHeight());
    }
}

class Physics
{
    public function push(Movable $obj, $x, $y)
    {
        $obj->move($x, $y);
    }
}

class Renderer
{
    public function render(Visible $obj)
    {
        foreach ($obj->getPoligons() as $poligon) {
            $this->renderPoligon($poligon, $obj->getColor());
        }
    }

    private function renderPoligon($poligon, $color) { }
}
###################################################

class Table implements Measurable, Visible
{
    public function getWidth() { return 95; }
    public function getHeight() { return 12; }
    public function getPoligons() { return []; }
    public function getColor() { return 0xFF0000; }
}

class Kettle implements Measurable, Movable, Visible
{
    public function move($x, $y) {  }
    public function getWidth() { return 9; }
    public function getHeight() { return 4; }
    public function getPoligons() { return []; }
    public function getColor() { return 0xFF0000; }
}

class Border implements Measurable
{
    public function getWidth() { return 9; }
    public function getHeight() { return 4; }
}

class Lamp implements Visible, Movable
{
    public function move($x, $y) {}
    public function getPoligons() { return []; }
    public function getColor() { return 0x00A900; }
}