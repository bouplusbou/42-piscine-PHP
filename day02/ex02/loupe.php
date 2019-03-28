#!/usr/bin/php
<?php
function strupper($text){
    return (mb_strtoupper($text[0]));
}
function replace($link){
    $link = preg_replace_callback('~(?<=title=")[^"]*~', strupper, $link);
    $link = preg_replace_callback("~(?<=>)[^<]*~", strupper, $link);
    return ($link[0]);
}
$page = file_get_contents($argv[1]);
$output = preg_replace_callback("~<a (.|\n)*?</a>~", replace, $page);
echo $output;
?>