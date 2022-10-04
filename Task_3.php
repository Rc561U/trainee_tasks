<?php

function convert_to_one_num(int $number): array|string
{
	if ($number <= 0) {
		return "Incorrect date entered. Only positive numbers";
	}

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


print_r(convert_to_one_num(123321));
