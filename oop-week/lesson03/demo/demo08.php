<?php
class Canvas
{
    public function paint($x, $y, $z)
    {
        return "[x = $x; y = $y; z = $z]\n";
    }

    public function line($x1, $y1, $z1, $x2, $y2, $z2)
    {
        return "[x = $x1; y = $y1; z = $z1] - [x = $x2; y = $y2; z = $z2]\n";
    }
}

$canvas = new Canvas();

$x = 5;
$y = 7;
$z = -2;

echo $canvas->paint($x, $y, $z);