<?php
function ft_split($str) 
{
	$arr = explode(" ", preg_replace('/ +/', ' ', $str));
	foreach (array_keys($arr, "") as $key) {
		unset($arr[$key]);
	}
	sort($arr);
	return ($arr);
}
?>