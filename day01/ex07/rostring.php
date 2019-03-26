#!/usr/bin/php
<?php
if ($argc >= 2) {
	$split = explode(" ", trim(preg_replace('/ +/', ' ', $argv[1])));
    $nb = count($split);
    for ($i = 1; $i < $nb; $i++) {
        echo $split[$i] . " ";
    }
    echo $split[0] . "\n";
}
?>