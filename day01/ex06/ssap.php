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

	foreach (array_slice($argv, 1) as $elem)
		$concat = $concat . " $elem";
	$split = ft_split($concat);
	sort($split);
	foreach ($split as $elem)
		echo "$elem\n";
?>