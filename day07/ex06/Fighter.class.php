<?php

abstract class Fighter  { 

	public $type;

	function __construct($type) {
		$this->type = $type;
	}

	abstract public function fight($target);
}

?>