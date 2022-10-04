<?php


function deleteByKey(array $arr, int $position): string|array
{
	if (count($arr) === 0) {
		return $arr;
	}
	if (!in_array($position, array_keys($arr))) {
		return "Position $position is not exist!";
	}

	unset($arr[$position]);

	if ($arr) {
		$keys = range(0, count($arr) - 1);
		return array_combine($keys, $arr);
	}

	return $arr;
}



var_dump(deleteByKey([1, 2, 3, 4, 5], 7));
echo "<br>";
var_dump(deleteByKey(['a', 'b', 'c', 'd'], 2));
echo "<br>";
var_dump(deleteByKey([], 0));
var_dump(deleteByKey([], 1));

echo "<br>";
var_dump(deleteByKey([1], 0));
var_dump(deleteByKey([1], -1));
