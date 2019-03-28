<?php
session_start();
date_default_timezone_set("Europe/Paris");
if (file_exists("../htdocs/private/chat")) {
	$fp = fopen("../htdocs/private/chat", "r");
	if (flock($fp, LOCK_SH)) { // acquière un verrou exclusif
		$file_msg = file_get_contents("../htdocs/private/chat");
		$arr_msg = unserialize($file_msg);
		foreach ($arr_msg as $msg) {
			$time = new DateTime('@' . $msg['time']);
			$time = $time->format('H:i');
			echo "[".$time."] <b>".$msg['login']."</b>: ".$msg['msg']."<br />\n";
		}
		fflush($fp);            // libère le contenu avant d'enlever le verrou
		flock($fp, LOCK_UN);    // Enlève le verrou
	} else {
		echo "Impossible de verrouiller le fichier !";
	}
	fclose($fp);
}
//[09:42] <b>user1</b>: Bonjours<br />
//[09:43] <b>user2</b>: Hello<br />
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	
</body>
</html>