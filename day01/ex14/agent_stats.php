#!/usr/bin/php
<?php
function moyenne($data) {
	$div = 0;
	foreach ($data as $elem) {
		if ($elem[Note] !== "" && $elem[Noteur] !== "moulinette") {
			$div++;
			$notes += $elem[Note];
		}
	}
	echo $notes / $div . "\n";
}

function parse_by_user($data) {
	$div = 0;
	foreach ($data as $elem) {
		if ($elem[Note] !== "" && $elem[Noteur] !== "moulinette") {
			$arr[$elem[User]][Notes] += $elem[Note];
			$arr[$elem[User]][Div] += 1;
		}
		if ($elem[Noteur] === "moulinette") {
			$arr[$elem[User]][Moulinette] = $elem[Note];
		}
	}
	ksort($arr);
	return ($arr);
}

function moyenne_user($data) {
	$arr = parse_by_user($data);
	foreach ($arr as $key => $value) {
		echo $key . ":" . $value[Notes] / $value[Div] . "\n";
	}
}

function ecart_moulinette($data) {
	$arr = parse_by_user($data);
	foreach ($arr as $key => $value) {
		$ecart = $value[Notes] / $value[Div] - $value[Moulinette];
		echo $key . ":" . $ecart . "\n";
	}
}

$i = 0;
while ($split = fgetcsv(STDIN, 1000, ";")) {
	$data[$i++] = array("User" => $split[0], "Note" => $split[1], "Noteur" => $split[2], "Feedback" => $split[3]);
}
if (isset($data)) {
	array_shift($data);
	if ($argv[1] === "moyenne") {
		moyenne($data);
	} elseif ($argv[1] === "moyenne_user") {
		moyenne_user($data);
	} elseif ($argv[1] === "ecart_moulinette") {
		ecart_moulinette($data);
	}
}
?>