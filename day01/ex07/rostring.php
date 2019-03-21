#!/usr/bin/php
<?php
if ($argc >= 2) {
	$split = explode(" ", trim(preg_replace('/\s+/', ' ', $argv[1])));
	$last = array_pop($split);
	$concat = "$last ";
	foreach ($split as $elem)
		$concat = $concat . "$elem ";
	echo trim($concat) . "\n";	
}
?>