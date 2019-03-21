#!/usr/bin/php
<?php
$split = array();
foreach (array_slice($argv, 1) as $elem) {
	$split = array_merge($split, explode(" ", trim(preg_replace('/\s+/', ' ', $elem))));
}
sort($split);
foreach ($split as $elem) {
	echo "$elem\n";
}
?>