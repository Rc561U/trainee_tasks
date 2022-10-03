<?php

function isGreater(int $number):string
{
	if ($number > 30) {
		return "More than 30";
	}
	elseif ($number > 20) {
		return "More than 20";
	}
	elseif ($number >10 ) {
		return "More than 10";
	}
	return "Equal or less than 10";
	
}


function isGreater_switch(int $number):string
{
	switch (true) 
	    {
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


function isGreater_ternar(int $number):string
{
	$result = $number > 10 ? "More than 10" : "Equal or less than 10";
    $result = $number > 20 ? "More than 20" : $result;
    return $number > 30 ? "More than 30" : $result;
}



$num_arr = array(-2,0,10,12,20,21,30,34,100);
foreach($num_arr as $number){
    echo "If-conditions for $number: ".isGreater($number)."<br>";
    echo "Switch for $number: ".isGreater_switch($number)."<br>";
    echo "Ternary for $number: ".isGreater_ternar($number)."<br>";
    echo "<br>";
}
