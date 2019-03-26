<?php
$username = $_SERVER[PHP_AUTH_USER];
$password = $_SERVER[PHP_AUTH_PW];

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Espace membres"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
} else {
	if ($username === "zaz" && $password === "jaimelespetitsponeys") {
		$imagedata = file_get_contents("../img/42.png");
		$base64 = base64_encode($imagedata);
		echo "<html><body>\n";
		echo "Bonjour Zaz<br />\n";
		echo "<img src='data:image/png;base64,$base64' >\n";
		echo "</body></html>\n";
	} else {
		echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";
	}
}
?>