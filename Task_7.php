<?php

function validUrl(string $url): string
{
	$url_validation_regex = "/https?:\/\/(www\.)?[-\w\d]{1,256}\.[\w\d]{1,6}\b([\w\d()\+.#?&-\/\/=]*)/";
	return preg_match($url_validation_regex, $url) ? "OK" : "Not a valid URL";
}


$url_arr = array(
	"https://stackoverflow.com/questions/206059/php-validation-regex-for-url",
	"https://innowise-group.com/",
	"ht://stackoverflow.com/",
	""
);

foreach ($url_arr as $url) {
	echo "$url : " . validUrl($url) . "<br>";
}
