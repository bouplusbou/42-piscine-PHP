#!/usr/bin/php
<?php
	echo "Entrez un nombre: ";
	$handle = fopen ("php://stdin","r");
	$line = fgets($handle);
	if ($line == NULL)
	{
		echo "^D\n";
		fclose($handle);
		return ;
	}
	$line = trim($line);
	if (!is_numeric($line))
		echo "'$line' n'est pas un chiffre\n";
	else if ($line % 2 == 0)
		echo "Le chiffre $line est Pair\n";
	else
		echo "Le chiffre $line est Impair\n";	
	fclose($handle);
?>