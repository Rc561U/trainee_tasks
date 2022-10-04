<?php


function NaturalNumbers(int $number, int $number2)
{
	if ($number === $number2) {
		echo "$number ";
		return $number;
	}
	if ($number <= $number2) {
		echo "$number, ";
		NaturalNumbers($number + 1, $number2);
	}
	if ($number >= $number2) {
		echo "$number, ";
		NaturalNumbers($number - 1, $number2);
	}
}


$num_arr = array([4, 9], [5, 5], [9, 4], [0, -6], [0, 6]);

foreach ($num_arr as $num) {
	NaturalNumbers($num[0], $num[1]);
	echo "<br>";
}
