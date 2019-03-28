#!/usr/bin/php
<?php
$data = fopen("/var/run/utmpx", "r");
while ($binary = fread($data, 628)) {
	$arr[] = unpack("A256user/A4id/A32tty/Ipid/Itype/Ltime/Lother/A256host/A64pad", $binary);
}
sort($arr);
date_default_timezone_set("Europe/Paris");
foreach($arr as $elem) {
    if ($elem['user'] !== "utmpx-1.00" && $elem['user'] != null && $elem['type'] == 7) {
		echo $elem['user'] . " " . $elem['tty'] . "  " . date("M j H:i", $elem['time']) . " \n";
    }
}
?>
