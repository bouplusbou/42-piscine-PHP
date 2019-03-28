<?php
session_start();
if (isset($_SESSION['loggued_on_user'])) {
	date_default_timezone_set("Europe/Paris");
	if ($_POST['submit'] === "OK")
	$arr_msg = array(“login” => $_SESSION['loggued_on_user'], “time” => time(), “msg” => $_POST['msg']);
	print_r($arr_msg);



}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Envoyer votre message</title>
</head>

<body>
	<form name="speak.php" action="speak.php" method="post">
		<label for="msg">Message: </label><input type="text" value="" name="msg" />
		<input type="submit" value="OK" name="submit" />
	</form>
</body>

</html>