<?php
if ($_POST["submit"] === "OK" && $_POST['login'] !== "" && $_POST['passwd'] !== "") {
	if (!file_exists("../private/")) {
		mkdir("../private/");
	}
	$login = $_POST['login'];
	$passwd = hash('sha512', $_POST['passwd']);
	if (file_exists("../private/passwd")) {
		$file_passwd = file_get_contents("../private/passwd");
		$arr_passwd = unserialize($file_passwd);
		foreach ($arr_passwd as $user) {
			if ($user['login'] === $login) {
				exit("ERROR\n");
			};
		}
	}
	$arr_passwd[] = array("login" => $login, "passwd" => $passwd);
	$arr_passwd_serialized = serialize($arr_passwd);
	file_put_contents("../private/passwd", "$arr_passwd_serialized");
	exit("OK\n");
} else {
	exit("ERROR\n");
}
?>