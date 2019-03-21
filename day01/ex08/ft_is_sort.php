<?php
function ft_is_sort($arr) {
    $copy = $arr;
    $rev_copy = $arr;
    sort($copy);
    rsort($rev_copy);
    if ($arr === $copy || $arr === $rev_copy) {
        return true;
	}
    return false;
}
?>