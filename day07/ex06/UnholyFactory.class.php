<?php

class UnholyFactory { 
	
	private $_soldiers = array();

	function absorb($recruit) {
		if (get_parent_class($recruit) == "Fighter") {
			if (!in_array($recruit->type, $this->_soldiers)) {
				print("(Factory absorbed a fighter of type " . $recruit->type . ")\n");
				$this->_soldiers[] = $recruit->type;
			} else {
				print("(Factory already absorbed a fighter of type " . $recruit->type . ")\n");
			}
		}
		else
			print("(Factory can't absorb this, it's not a fighter)\n");
	}

	function fabricate($rf) {
		if ($rf === "foot soldier" || $rf === "archer" || $rf === "assassin")
			print("(Factory fabricates a fighter of type " . $rf . ")\n");
		else {
			print("(Factory hasn't absorbed any fighter of type " . $rf . ")\n");
			return;
		}
		switch ($rf) {
			case ("foot soldier"):
				return new Footsoldier();
				break;
			case ("archer"):
				return new Archer();
				break;
			case ("assassin"):
				return new Assassin();
				break;
		}
	}
}
?>