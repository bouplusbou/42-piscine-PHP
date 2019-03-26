#!/usr/bin/php
<?php
if ($argc != 4) {
	exit("Incorrect Parameters\n");
}
$a = preg_replace('/[ \t]/', '', $argv[1]);
$op = preg_replace('/[ \t]/', '', $argv[2]);
$b = preg_replace('/[ \t]/', '', $argv[3]);
if ($op == '+') {
	echo $a + $b . "\n";
} elseif ($op == '-') {
	echo $a - $b . "\n";
} elseif ($op == '*') {
	echo $a * $b . "\n";
} elseif ($op == '/') {
	echo $a / $b . "\n";
} elseif ($op == '%') {
	echo $a % $b . "\n";
}
?>