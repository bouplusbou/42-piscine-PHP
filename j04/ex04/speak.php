<?php
session_start();
if (isset($_SESSION['loggued_on_user']) && isset($_POST['msg'])) {
	if ($_POST['submit'] === "OK")
	// print_r($arr_msg);
	if (!file_exists("../htdocs/")) {
		mkdir("../htdocs/");
	}
	if (!file_exists("../htdocs/private/")) {
		mkdir("../htdocs/private/");
	}
	if (!file_exists("../htdocs/private/chat")) {
		file_put_contents("../htdocs/private/chat", "");
	}
	$fp = fopen("../htdocs/private/chat", "r+");
	if (flock($fp, LOCK_EX)) { // acquière un verrou exclusif
		$file_msg = file_get_contents("../htdocs/private/chat");
		$arr_msg = unserialize($file_msg);
		date_default_timezone_set("Europe/Paris");
		$arr_msg[] = array("login" => $_SESSION['loggued_on_user'], "time" => time(), "msg" => $_POST['msg']);
		// print_r($arr_msg);
		$arr_msg_serialized = serialize($arr_msg);
		file_put_contents("../htdocs/private/chat", "$arr_msg_serialized");
		fflush($fp);            // libère le contenu avant d'enlever le verrou
		flock($fp, LOCK_UN);    // Enlève le verrou
	} else {
		echo "Impossible de verrouiller le fichier !";
	}
	fclose($fp);
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Envoyer votre message</title>
	<script langage="javascript">top.frames[chat].location = chat.php;</script>
</head>

<body>
	<form name="speak.php" action="speak.php" method="post">
		<label for="msg">Message: </label><input type="text" value="" name="msg" />
		<input type="submit" value="OK" name="submit" />
	</form>
</body>

</html>