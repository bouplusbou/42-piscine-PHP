<?php
session_start();
if ($_GET["submit"] == "OK" && isset($_GET["login"])) {
	$_SESSION["login"] = $_GET["login"];
}
if ($_GET["submit"] == "OK" && isset($_GET["passwd"])) {
	$_SESSION["passwd"] = $_GET["passwd"];
}
?>
<html><body>
  <form name="index.php" action="" method="get">
    <label for="login">Identifiant: </label><input type="text" value="<?= $_SESSION["login"] ?>" name="login" />
    <label for="passwd">Mot de passe: </label><input type="passwd" value="<?= $_SESSION["passwd"] ?>" name="passwd" />
    <input type="submit" value="OK" name="submit" />
  </form>
</body></html>