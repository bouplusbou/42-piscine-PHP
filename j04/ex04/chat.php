<?php
session_start();
date_default_timezone_set("Europe/Paris");
if (file_exists("../private/chat")) {
	$fp = fopen("../private/chat", "r");
	if (flock($fp, LOCK_SH)) { // acquière un verrou exclusif
		$file_msg = file_get_contents("../private/chat");
		fflush($fp);            // libère le contenu avant d'enlever le verrou
		flock($fp, LOCK_UN);    // Enlève le verrou
	} else {
		echo "Impossible de verrouiller le fichier !";
	}
		$arr_msg = unserialize($file_msg);
		foreach ($arr_msg as $msg) {
			$time = new DateTime('@' . $msg['time']);
			$time = $time->format('H:i');
			echo "[".$time."] <b>".$msg['login']."</b>: ".$msg['msg']."<br />\n";
		}
	fclose($fp);
}
?>