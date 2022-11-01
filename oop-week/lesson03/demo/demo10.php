<?php
class Canvas
{
    public function paint(Point $point)
    {
        list($x, $y, $z) = $point->getPointCoordinates();
        return "[x = $x; y = $y; z = $z]\n";
    }

    public function line(Point $from, Point $to)
    {
        list($x1, $y1, $z1) = $from->getPointCoordinates();
        list($x2, $y2, $z2) = $to->getPointCoordinates();
        return "[x = $x1; y = $y1; z = $z1] - [x = $x2; y = $y2; z = $z2]\n";
    }
}

############################################
abstract class Point
{
    abstract public function getPointCoordinates();
}

class DecartPoint extends Point
{
    public $x;
    public $y;
    public $z;

    public function getPointCoordinates(): array
    {
        return [
            $this->x,
            $this->y,
            $this->z
        ];
    }
}

class CilindricalPoint extends Point
{
    public $f;
    public $r;
    public $h;

    public function getPointCoordinates(): array
    {
        return [
            $this->r * cos($this->f),
            $this->r * sin($this->f),
            $this->h
        ];
    }
}

class SphericalPoint extends Point
{
    public $r;
    public $f;
    public $t;

    public function getPointCoordinates(): array
    {
        return [
            $this->r * cos($this->f) * sin($this->t),
            $this->r * sin($this->f) * cos($this->t),
            $this->r * cos($this->t)
        ];
    }
}

############################################
$canvas = new Canvas();

$decartPoint = new DecartPoint();
$decartPoint->x = 5;
$decartPoint->y = 7;
$decartPoint->z = -2;
echo $canvas->paint($decartPoint);

$cilindricalPoint = new CilindricalPoint();
$cilindricalPoint->f = 5;
$cilindricalPoint->r = 7;
$cilindricalPoint->h = -2;
echo $canvas->paint($cilindricalPoint);

$sphericalPoint = new SphericalPoint();
$sphericalPoint->r = 5;
$sphericalPoint->f = 7;
$sphericalPoint->t = -2;
echo $canvas->paint($sphericalPoint);