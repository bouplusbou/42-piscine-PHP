#!/usr/bin/php
<?php
$header_keys = array("nom", "prenom", "mail", "IP", "pseudo");
if ($argc != 3 || !file_exists($argv[1]) || !in_array($argv[2], $header_keys)) {
	exit();
}
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