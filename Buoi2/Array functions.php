<?php
function GTLN($array) {
    return max($array);
}

function GTNN($array) {
    return min($array);
}

function tinhtong($array) {
    return array_sum($array);
}

function kiemtra($array, $element) {
    return in_array($element, $array);
}

function sapxep(&$array) {
    sort($array);
}
?>
