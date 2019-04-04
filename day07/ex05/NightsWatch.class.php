<?php

class NightsWatch implements IFighter { 
	
	private $_recruits = array();
	
	function recruit($recruit) {
		$this->_recruits[] = $recruit;
	}
	
	function fight() {
		foreach ($this->_recruits as $recruit) {
			if ($recruit instanceof IFighter)
				$recruit->fight();
		}
	}
	
}

?>