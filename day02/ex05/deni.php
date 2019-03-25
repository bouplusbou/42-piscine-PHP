#!/usr/bin/php
<?php


// checker si certaines key ne sont pas crees



// function inv_header_key($str)
// {
// 	if ($str === "nom" || $str === "prenom" || $str === "mail" || $str === "IP" || $str === "pseudo") {
// 		return false;
// 	} else {
// 		return true;
// 	}
// }
// if ($argc != 3 || !file_exists($argv[1]) || inv_header_key($argv[3])) {
// 	exit();
// }
if (($handle = fopen($argv[1], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		for ($i = 0; $i <= 4; $i++) {
			$nom[$data[$i]] = $data[0];
			$prenom[$data[$i]] = $data[1];
			$mail[$data[$i]] = $data[2];
			$IP[$data[$i]] = $data[3];
			$pseudo[$data[$i]] = $data[4];
		}
	}
    fclose($handle);
}
while (true) {
	echo "Entrez votre commande: ";
	if (($input = fgets(STDIN)) == NULL) {
		exit("\n");
	}
	eval($input);
}
?>
