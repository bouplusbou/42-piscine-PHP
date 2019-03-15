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
?>