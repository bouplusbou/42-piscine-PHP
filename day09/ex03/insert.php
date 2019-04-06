<?php

if( isset($_POST['id']) && isset($_POST['todo']) ){

	$handle = fopen("list.csv", "a");
	$line[] = $_POST['id'];
	$line[] = $_POST['todo'];
	fputcsv($handle, $line, ";");
	fclose($handle);
}