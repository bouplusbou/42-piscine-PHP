<?php
session_start();
include 'auth.php';
$login = $_GET['login'];
$passwd = hash('sha512', $_GET['passwd']);
if (auth($login, $passwd)) {
	$_SESSION['loggued_on_user'] = $login;
	exit("OK\n");
} else {
	$_SESSION['loggued_on_user'] = "";
	exit("ERROR\n");
}
?>