#!/usr/bin/php
<?php
if ($argc != 2 || !file_exists($argv[1])) {
    exit();
}
$file = fopen($argv[1], "r");

?>