<?php
$items = [2, 5, 3, 12];

$square = function($a) {
    return $a * $a;
};

// В функциональном стиле.
function map($func, $items) {

    if (count($items) > 1) {
        return array_merge(
            [$func(reset($items))],
            map($func, array_slice($items, 1))
        );

    } else {
        return [$func(reset($items))];
    }
}
print_r(map($square, $items));


// В процедурном стиле.
$result = [];
foreach ($items as $item) {
    $result[] = $square($item);
}
print_r($result);