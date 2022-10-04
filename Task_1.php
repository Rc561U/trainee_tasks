<?php

function is_greater(int $number): string
{
    if ($number > 30) {
        return "More than 30";
    } elseif ($number > 20) {
        return "More than 20";
    } elseif ($number > 10) {
        return "More than 10";
    }
    return "Equal or less than 10";
}


function is_greater_switch(?int $number): string
{
    switch ($number) {
        case $number > 30:
            return "More than 30";
        case $number > 20:
            return "More than 20";
        case $number > 10:
            return "More than 10";
        default:
            return "Equal or less than 10";
    }
}


function is_greater_ternary(int $number): string
{
    return ($number > 30 ? "More than 30" : 
           ($number > 20 ? "More than 20" : 
           ($number > 10 ? "More than 10" : "Equal or less than 10")));
        }



$num_arr = array(-2, 0, 10, 12, 20, 21, 30, 34, 100);
foreach ($num_arr as $number) {
    echo "If-conditions for $number: " . is_greater($number) . "<br>";
    echo "Switch for $number: " . is_greater_switch($number) . "<br>";
    echo "Ternary for $number: " . is_greater_ternary($number) . "<br>";
    echo "<br>";
}
