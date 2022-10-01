<?php 

function convert_to_one_num($number)
{
	if (strlen($number) == 1) {
		return $number;
	}
	while (strlen($number) > 1) {
		$int_to_array = str_split($number);
		$sum_of_array = array_sum($int_to_array);
		$number = strval($sum_of_array);
	}
	return $number;	

}

$nums = array(5689,800000,15,0,42135123);

foreach ($nums as $num) {
	$result = convert_to_one_num($num);
	echo $result. "<br>";
}
