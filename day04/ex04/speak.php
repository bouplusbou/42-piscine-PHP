<?php
session_start();
date_default_timezone_set("Europe/Paris");
if ($_SESSION['loggued_on_user'] == "") {
	exit("ERROR\n");;
}
if (isset($_POST['msg'])) {
	if ($_POST['submit'] === "OK")
	if (!file_exists("../private/")) {
		mkdir("../private/");
	}
	if (!file_exists("../private/chat")) {
		file_put_contents("../private/chat", "");
	}
	$fp = fopen("../private/chat", "r");
	if (flock($fp, LOCK_SH)) {
		$file_msg = file_get_contents("../private/chat");
		flock($fp, LOCK_UN);
	}
	fclose($fp);
	$arr_msg = unserialize($file_msg);
	$arr_msg[] = array("login" => $_SESSION['loggued_on_user'], "time" => time(), "msg" => $_POST['msg']);
	$arr_msg_serialized = serialize($arr_msg);
	file_put_contents("../private/chat", "$arr_msg_serialized", LOCK_EX);
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Envoyer votre message</title>
	<script langage="javascript">top.frames["chat"].location = "chat.php";</script>
</head>

<body>
	<form name="speak.php" action="speak.php" method="post">
		<label for="msg">Message: </label><input type="text" value="" name="msg" />
		<input type="submit" value="OK" name="submit" />
	</form>
</body>

</html>