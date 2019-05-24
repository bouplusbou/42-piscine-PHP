<?php
session_start();
if ($_GET["submit"] == "OK" && $_GET["login"] !== "" && $_GET["passwd"] !== "") {
	$_SESSION["login"] = $_GET["login"];
	$_SESSION["passwd"] = $_GET["passwd"];
}
?>
<html><body>
  <form name="index.php" action="index.php" method="get">
    <label for="login">Identifiant: </label><input type="text" value="<?= $_SESSION["login"] ?>" name="login" />
    <label for="passwd">Mot de passe: </label><input type="password" value="<?= $_SESSION["passwd"] ?>" name="passwd" />
    <input type="submit" value="OK" name="submit" />
  </form>
</body></html>
