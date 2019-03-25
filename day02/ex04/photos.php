#!/usr/bin/php
<?php
if ($argc == 2) {
	preg_match("~//(.*)~", $argv[1], $dir);
	if (!file_exists($dir[1])) {
		mkdir($dir[1], 0755, true);
	}
	$page = file_get_contents($argv[1]);
	preg_match_all("~<img .*?>~", $page, $images);
	foreach ($images[0] as $image) {
		preg_match("~src=\"(.*?)\"~", $image, $src);
		$paths[] = $src[1];
	}
	foreach ($paths as $path) {
		if (preg_match("~(https?://)~", $path)) {
			$path_parts = pathinfo($path);
			$parsed_url = parse_url($path_parts['basename']);
			$path_parts = pathinfo($parsed_url[path]);
			$dir_path = $dir[1] . "/" . $path_parts[filename] . "." . $path_parts[extension];
			$counter = 0;
    		while (file_exists($dir_path)) {
				$dir_path = $dir[1] . "/" . $path_parts[filename] . "_" . $counter. "." . $path_parts[extension];
           		$counter++;
     		}
			file_put_contents($dir_path, file_get_contents($path));
		} 
		elseif ($path) {
			if (preg_match("~^/~", $path)) {
				$path = $argv[1] . $path;
			} else {
				$path = $argv[1] . "/" . $path;
			}
			$path_parts = pathinfo($path);
			$parsed_url = parse_url($path_parts['basename']);
			$path_parts = pathinfo($parsed_url[path]);
			$dir_path = $dir[1] . "/" . $path_parts[filename] . "." . $path_parts[extension];
			$counter = 0;
    		while (file_exists($dir_path)) {
				$dir_path = $dir[1] . "/" . $path_parts[filename] . "_" . $counter. "." . $path_parts[extension];
           		$counter++;
     		}
			file_put_contents($dir_path, file_get_contents($path));
		}
	}
}
?>