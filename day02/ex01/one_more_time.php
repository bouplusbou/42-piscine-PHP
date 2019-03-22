#!/usr/bin/php
<?php
if ($argc >= 2) {
	if (preg_match('/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)\s([0-9]{1,2})\s([Jj]anvier|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]ecembre)\s([0-9]{4})\s([0-9]{2}):([0-9]{2}):([0-9]{2})$/', $argv[1], $matches)) {
		date_default_timezone_set('Europe/Paris');
		$date = strtolower($argv[1]);
		$day_fr   = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
		$day_en = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
		$date = str_replace($day_fr, $day_en, $date);
		$month_fr   = array("janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
		$month_en = array("january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december");
		$date = str_replace($month_fr, $month_en, $date);
		if (strtotime($date)) {
			echo strtotime($date) . "\n";
		} else {
			exit("Wrong Format\n");
		}
	} else {
		exit("Wrong Format\n");
	}
}
?>