<?php
session_start();
date_default_timezone_set("Europe/Paris");
if (file_exists("../private/chat")) {
	$fp = fopen("../private/chat", "r");
	if (flock($fp, LOCK_SH)) {
		$file_msg = file_get_contents("../private/chat");
		flock($fp, LOCK_UN);
	}
	fclose($fp);
	$arr_msg = unserialize($file_msg);
	foreach ($arr_msg as $msg) {
		$time = date("H:i", $msg['time']);
		echo "[".$time."] <b>".$msg['login']."</b>: ".$msg['msg']."<br />\n";
	}
}
?>