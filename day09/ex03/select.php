<?php
	if (($handle = fopen("list.csv", "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$tmp = explode(";", $data[0]);
			print("<div id=\"$tmp[0]\">$tmp[1]</div>");
	    }
	    fclose($handle);
	}