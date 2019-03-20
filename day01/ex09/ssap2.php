#!/usr/bin/php
<?php
function ft_split($str)
{
	$arr = array();
	$expl = explode(" ", $str);
	foreach ($expl as $elem)
		if ($elem)
			array_push($arr, $elem);
	return ($arr);
}

function ssap2_cmp($b, $a)
{
	$a = strtolower($a);
	$b = strtolower($b);
	$i = 0;
	while (isset($a[$i]) && isset($b[$i]) && ($a[$i] == $b[$i]))
		$i++;
	if (isset($a[$i]) && isset($b[$i]))
	{
		if ('a' <= $a[$i] && $a[$i] <= 'z')
		{
			if ('a' <= $b[$i] && $b[$i] <= 'z')
				return ($a[$i] < $b[$i] ? 1 : -1);
			else
				return 1;
		}
		else if (is_numeric($a[$i]))
		{
			if (is_numeric($b[$i]))
				return ($a[$i] < $b[$i] ? 1 : -1);
			else if ('a' <= $b[$i] && $b[$i] <= 'z')
				return -1;
			else
				return 1;
		}
		else
		{
			if (('a' <= $b[$i] && $b[$i] <= 'z') || is_numeric($b[$i]))
				return -1;
			else
				return ($a[$i] < $b[$i] ? 1 : -1);
		}
	}
	return (!isset($a[$i]) ? 1 : -1);
}

foreach (array_slice($argv, 1) as $elem)
	$concat = $concat . " $elem";
$split = ft_split($concat);
usort($split, "ssap2_cmp");
foreach ($split as $elem)
	echo "$elem\n";
?>