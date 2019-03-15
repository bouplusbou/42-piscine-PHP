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

	$split = ft_split($argv[1]);
	$last = array_pop($split);
	$concat = $last . " ";
	foreach ($split as $elem)
		$concat = $concat . "$elem ";
	echo trim($concat) . "\n";
?>