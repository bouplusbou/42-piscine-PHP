#!/usr/bin/php
<?php
if ($argc == 1 || !file_exists($argv[1])) {
	exit;
}
$fd = fopen($argv[1], "r");
while ($line = fgets($fd)) {
	if (preg_match("~-->~", $line)) {
		while (($lol = fgets($fd)) && $lol[0] != "\n") {
			$srt .= $lol . "\n";
		}
		$arr[$line] = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $srt);;
		unset($srt);
	}
}
ksort($arr);
$counter = 1;
foreach($arr as $time => $srt) {
	if ($counter != 1) {
		echo "\n";
	}
	echo $counter . "\n";
	echo $time;
	echo $srt;
	$counter++;
}
fclose($fd);
?>