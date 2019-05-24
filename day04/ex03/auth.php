<?php
function auth($login, $passwd)
{
	if ($login && $passwd && file_exists("../private/passwd")) {
		$file_passwd = file_get_contents("../private/passwd");
		$arr_passwd = unserialize($file_passwd);
		foreach ($arr_passwd as $user) {
			if ($user['login'] === $login && $user['passwd'] === $passwd) {
				return true;
			};
		}
	}; 
	return false;
}
?>