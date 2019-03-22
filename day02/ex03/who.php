#!/usr/bin/php
<?php
$binaryData = file_get_contents("/var/run/utmpx");
$output[] = unpack("A256user/A4id/A32tty/Ipid/Itype/Ltime/Lother/A256host/A64pad", $binaryData);
print_r($output);
?>
