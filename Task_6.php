<?php 


function removeSpaces($text)
{
	$order   = array("-", "_");
	$newstr = trim(str_replace($order, " ", $text));

	$word_capitalize = ucwords($newstr);
	$splited_by_spaces = explode(" ", $word_capitalize);
	$joined_str = join("", $splited_by_spaces);
	return $joined_str;
}



$arr_strs     = [
    "               The quick-brown_fox jumps over the_lazy-dog       ",
    "    _d-   ",
    "returns a string where all the individual words begin with _a -capital letter"
    ];
    
foreach($arr_strs as $str){
    $result = removeSpaces($str);
    echo $result;
    echo "\n";
}