<?php
if ($_POST["submit"] === "OK" && $_POST["newpw"] !== "") {
	$login = $_POST['login'];
	$oldpw = hash('sha512', $_POST['oldpw']);
	$newpw = hash('sha512', $_POST['newpw']);
	if (file_exists("../htdocs/private/passwd")) {
		$file_passwd = file_get_contents("../htdocs/private/passwd");
		$arr_passwd = unserialize($file_passwd);
		foreach ($arr_passwd as &$user) {
			if ($user['login'] === $login && $user['passwd'] === $oldpw) {
				$user['passwd'] = $newpw;
				$arr_passwd_serialized = serialize($arr_passwd);
				file_put_contents("../htdocs/private/passwd", "$arr_passwd_serialized");
				exit("OK\n");
			} else {
				exit("ERROR\n");
			};
		}
	}
} else {
	exit("ERROR\n");
}
?>