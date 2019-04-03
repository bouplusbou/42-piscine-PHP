<?php
Class Vector 
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;

	static $verbose = False;

	public function getX() {return $this->_x;}
	public function getY() {return $this->_y;}
	public function getZ() {return $this->_z;}
	public function getW() {return $this->_w;}

	function __construct(array $kwargs) {
		if (isset($kwargs['dest'])) {
			if (isset($kwargs['orig']))
				$orig = $kwargs['orig'];
			else
				$orig = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0));
			$this->_x = $kwargs['dest']->getX() - $orig->getX();
			$this->_y = $kwargs['dest']->getY() - $orig->getY();
			$this->_z = $kwargs['dest']->getZ() - $orig->getZ();
			$this->_w = $kwargs['dest']->getW() - $orig->getW();
			if (self::$verbose) {
				print($this->__toString() . " constructed\n");
			}
		}
		return;
	}

	function __toString() {
		return (vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
	}
	
	function __destruct() {
		if (self::$verbose) {
			print($this->__toString() . " destructed\n");
		}
		return;
	}

	static function doc() {
		$file = file_get_contents('Vector.doc.txt');
		print($file);
	}

	public function magnitude() {
        return sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z);
	}
	
	public function normalize() {
		$mag = $this->magnitude();
		if ($mag > 0) {
			$dest = new Vertex(array('x' => $this->_x / $mag, 'y' => $this->_y / $mag, 'z' => $this->_z / $mag));
			return (new Vector(array('dest' => $dest)));
		}
	}

	public function add(Vector $rhs) {
		$dest = new Vertex(array('x' => $this->_x + $rhs->getX(), 'y' => $this->_y + $rhs->getY(), 'z' => $this->_z + $rhs->getZ()));
		return (new Vector(array('dest' => $dest)));
	}

	public function sub(Vector $rhs) {
		$dest = new Vertex(array('x' => $this->_x - $rhs->getX(), 'y' => $this->_y - $rhs->getY(), 'z' => $this->_z - $rhs->getZ()));
		return (new Vector(array('dest' => $dest)));
	}

	public function opposite() {
		$dest = new Vertex(array('x' => $this->_x * -1, 'y' => $this->_y * -1, 'z' => $this->_z * -1));
		return (new Vector(array('dest' => $dest)));
	}

	public function scalarProduct($k) {
		$dest = new Vertex(array('x' => $this->_x * $k, 'y' => $this->_y * $k, 'z' => $this->_z * $k));
		return (new Vector(array('dest' => $dest)));
	}

	public function dotProduct(Vector $rhs) {
		return ($this->_x * $rhs->getX() + $this->_y * $rhs->getY() + $this->_z * $rhs->getZ());
	}

	public function crossProduct(Vector $rhs) {
		$dest = new Vertex(array('x' => ($this->_y * $rhs->getZ() - $this->_z * $rhs->getY()), 'y' => ($this->_z * $rhs->getX() - $this->_x * $rhs->getZ()), 'z' => ($this->_x * $rhs->getY() - $this->_y * $rhs->getX())));
		return (new Vector(array('dest' => $dest)));
	}

	public function cos(Vector $rhs) {
		return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
	}
}
?>