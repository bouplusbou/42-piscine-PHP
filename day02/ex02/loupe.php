#!/usr/bin/php
<?php
function get_inside($quote_chevron)
{
	return (strtoupper($quote_chevron[0]));
}
function get_quote_chevron($link)
{
	$quote_chevron = preg_replace_callback("~(\"|')(.*)(\"|')|>(.|\s)*?<~", get_inside, $link);
	return ($quote_chevron[0]);
}
$page = file_get_contents($argv[1]);
$output = preg_replace_callback("~<a(.|\n)*?</a>~", get_quote_chevron, $page);
echo "$output\n";
?>