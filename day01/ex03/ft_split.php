<?php
function ft_split($str) 
{
	$arr = explode(" ", trim(preg_replace('/\s+/', ' ', $str)));
	sort($arr);
	return ($arr);
}
?>