#!/usr/bin/php
<?php
if ($argc != 2) {
	exit("Incorrect Parameters\n");
}
preg_match('/^\s*([0-9]{1,})\s*([+\-\/%*])\s*([0-9]{1,})\s*$/', $argv[1], $matches);
if (empty($matches)) {
	exit("Syntax Error\n");
}
$a = $matches[1];
$op = $matches[2];
$b = $matches[3];
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
