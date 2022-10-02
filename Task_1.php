<?php

function isGreater(int $number):string
{
	if ($number > 30) {
		return "More than 30";
	}
	elseif ($number > 20 && $number <= 30) {
		return "More than 20";
	}
	elseif ($number >10 && $number <= 20) {
		return "More than 10";
	}
	else
	{
		return "Equal or less than 10";
	}
}


function isGreater_switch(int $number):string
{
	switch ($number) {
	    case 0 || $number <= 10:
	        return "Equal or less than 10";
			break;
			
		case $number > 30:
			return "More than 30";
			break;
			
		case $number > 20 && $number <= 30:
			return "More than 20";
			break;
			
		case $number >10 && $number <= 20:
			return "More than 10";
			break;
	}
}


function isGreater_ternar(int $number):string
{
	 $result = (
     ($number > 30) ? "More than 30" :
      (($number > 20 && $number <= 30) ? "More than 20" :
       (($number >10 && $number <= 20) ? "More than 10" :
        (($number <= 10) ? "Equal or less than 10" : null )))
     );
     return $result;
}



$num_arr = array(-2,0,10,12,20,21,30,34,100);
foreach($num_arr as $number){
    echo "If-conditions for $number: ".isGreater($number)."\n";
    echo "Switch for $number: ".isGreater_switch($number)."\n";
    echo "Ternary for $number: ".isGreater_ternar($number)."\n";
    echo "\n";
}