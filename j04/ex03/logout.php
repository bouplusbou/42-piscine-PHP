<?php
session_start();
//remove PHPSESSID from browser
setcookie($_COOKIE['PHPSESSID'], "", time()-3600);
//clear session from globals
$_SESSION = array();
//clear session from disk
session_destroy();
?>