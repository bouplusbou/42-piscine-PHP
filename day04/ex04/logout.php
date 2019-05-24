<?php
session_start();
setcookie($_COOKIE['PHPSESSID'], "", time()-3600);
$_SESSION = array();
session_destroy();
?>