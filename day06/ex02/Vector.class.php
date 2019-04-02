<?php
Class Vector 
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;

	static $verbose = False;

	public function getX() {return $this->_x;}
	public function getY() {return $this->_y;}
	public function getZ() {return $this->_z;}
	public function getW() {return $this->_w;}

	function __construct(array $kwargs) {
		if (isset($kwargs['dest'])) {
			$this->_x = $kwargs['x'];
        	$this->_y = $kwargs['y'];
			$this->_z = $kwargs['z'];
			$this->_w = 1.0;
			if (isset($kwargs['w']))
				$this->_w = $kwargs['w'];
			if (isset($kwargs['color']))
				$this->_color = $kwargs['color'];
			else
				$this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
			if (self::$verbose) {
				print($this->__toString() . " constructed\n");
			}
		}
		return;
	}

	function __toString() {
		if (self::$verbose) {
			return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )", array($this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue)));
		} else {
			return (vsprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
		};
	}
	
	function __destruct() {
		if (self::$verbose) {
			print($this->__toString() . " destructed\n");
		}
		return;
	}

	static function doc() {
		$file = file_get_contents('Vertex.doc.txt');
		print($file);
	}
}
?>