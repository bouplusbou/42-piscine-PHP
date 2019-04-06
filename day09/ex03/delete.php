<?php

if(isset($_POST['id'])) {
	$id = $_POST['id'];
	$handle_tmp = fopen("list_tmp.csv", "a");
	if (($handle = fopen("list.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$tmp = explode(";", $data[0]);
			if ($tmp[0] !== $id)
				fputcsv($handle_tmp, $data);
		}
		fclose($handle);
	}
	fclose($handle_tmp);
	rename("list_tmp.csv", "list.csv");
}





