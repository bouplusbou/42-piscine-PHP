<?php

abstract class Lannister {

    public function sleepWith($sis_bros) {
        if ($sis_bros instanceof Lannister)
            echo "Not even if I'm drunk !\n";
        else
            echo "Let's do this.\n";
	}
	
}

?>
