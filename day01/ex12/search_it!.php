#!/usr/bin/php
<?php
if ($argc >= 3) {
	foreach (array_slice($argv, 2) as $elem) {
		$tmp = explode(":", $elem);
		if ($tmp[0] === $argv[1]) {
			$value = $tmp[1];
		}
	}
	if (!empty($value)) {
		echo "$value\n";
	}
}
?>