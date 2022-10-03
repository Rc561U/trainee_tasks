<?php 


function deleteByKey(array $arr, int $position):array
{
	unset($arr[$position]);
	$result = array_values($arr);
	return $result;

}


$arrays = array(
	[1,2,3,4,5],
	['a','b','c','d'],
	[]
); 


foreach ($arrays as $arr) {
	$rand_position = rand(0,count($arr));
	// $position = 3; 
	$result_arr = deleteByKey($arr,$rand_position); // or $positon
	echo "Before removal<br>";
	print_r($arr);
	echo "<br>";
	echo "Delete element on $rand_position position:<br>";
	print_r($result_arr);
	echo "<br><br>";
	
}


