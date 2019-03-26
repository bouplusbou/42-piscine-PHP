#!/usr/bin/php
<?php
while (true) {
	echo "Entrez un nombre: ";
	if (($input = fgets(STDIN)) == NULL) {
        exit("\n");
	}
	$input = trim($input);
	if (!is_numeric($input)) {
		echo "'$input' n'est pas un chiffre\n";
	} elseif (substr($input, -1) % 2 == 0) {
		echo "Le chiffre $input est Pair\n";
	} else {
		echo "Le chiffre $input est Impair\n";	
	}	
}
?>