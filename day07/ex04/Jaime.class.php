<?php

class Jaime extends Lannister {

	function sleepWith($sis_bros) {
		if (get_class($sis_bros) == "Tyrion")
			print("Not even if I'm drunk !\n");
		elseif (get_class($sis_bros) == "Cersei")
			print("With pleasure, but only in a tower in Winterfell, then.\n");
		else
			print("Let's do this.\n");
	}

}

?>