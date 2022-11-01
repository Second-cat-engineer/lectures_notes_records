<?php
class Canvas
{
    public function paintDecart($x, $y, $z)
    {
        return "[x = $x; y = $y; z = $z]\n";
    }

    public function paintCilindrical($f, $r, $h)
    {
        return $this->paintDecart($r * cos($f), $r * sin($f), $h);
    }

    public function paintSpherical($r, $f, $t)
    {
        return $this->paintDecart($r * cos($f) * sin($t), $r * sin($f) * cos($t), $r * cos($t));
    }

    // ...
}
############################################
$canvas = new Canvas();
$x = 5;
$y = 7;
$z = -2;
echo $canvas->paintDecart($x, $y, $z);

$f = 1.7;
$r = 5;
$h = 8;
echo $canvas->paintCilindrical($f, $r, $h);

$r = 8;
$f = 1.7;
$t = 2.5;
echo $canvas->paintSpherical($r, $f, $t);