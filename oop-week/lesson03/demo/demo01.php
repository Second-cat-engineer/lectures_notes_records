<?php
// Наследование.
class Base
{
    public string $name = 'Safuan';

    public function first(): string
    {
        return 'first';
    }
}

//class Sub
//{
//    public string $nam = 'Safuan';
//    public string $description = 'description';
//
//    public function first(): string
//    {
//        return 'first';
//    }
//}

class Sub extends Base
{
    public string $description = 'description';

    public function first(): string
    {
        return 'first sub';
    }
}

$base = new Base();
echo $base->first() . PHP_EOL;

$sub = new Sub();
echo $sub->first() . PHP_EOL;