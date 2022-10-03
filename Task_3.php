<?php 

function convert_to_one_num($number)
{	
	if ($number <= 0) {return "Incorrect date entered. Only positive numbers";}

	$result_arr = [];
	if (strlen($number) == 1) {
		$result_arr[] = $number;
	}

	while (strlen($number) > 1) {
		$int_to_array = str_split($number);
		$sum_of_array = array_sum($int_to_array);
		$number = strval($sum_of_array);
		$result_arr[] = $number;
	}
	return $result_arr;	

}


$nums = array(-111, 5689,800000,15,0,42135123,1283);

foreach ($nums as $num) {
	$result = convert_to_one_num($num);
	
	echo is_array($result) ? json_encode(convert_to_one_num($num)) : $result;

	echo "<br>";
}
