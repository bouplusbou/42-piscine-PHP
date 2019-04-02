<?php
Class Color 
{
	public $red;
	public $green;
	public $blue;

	static $verbose = False;

	function __construct($kwargs) {
		if (isset($kwargs['rgb'])) {
			$this->red = intval($kwargs['rgb']) >> 16 & 0xFF;
            $this->green = intval($kwargs['rgb']) >> 8 & 0xFF;
            $this->blue = intval($kwargs['rgb']) & 0xFF;
		} else {
            $this->red = intval($kwargs['red']);
            $this->green = intval($kwargs['green']);
            $this->blue = intval($kwargs['blue']);
		}
		if (self::$verbose) {
			print($this->__toString() . " constructed.\n");
		}
		return;
	}

	function __destruct() {
		if (self::$verbose) {
			print($this->__toString() . " destructed.\n");
		}
		return;
	}

    function __toString() {
        return (vsprintf("Color( red: %3d, green: %3d, blue: %3d )", array($this->red, $this->green, $this->blue)));
    }

	static function doc() {
		$file = file_get_contents('Color.doc.txt');
		print($file);
	}

	public function add ($color) {
        return (new Color(array('red' => $this->red + $color->red, 'green' => $this->green + $color->green, 'blue' => $this->blue + $color->blue)));
	}

	public function sub ($color) {
        return (new Color(array('red' => $this->red - $color->red, 'green' => $this->green - $color->green, 'blue' => $this->blue - $color->blue)));
	}

	public function mult ($fact) {
        return (new Color(array('red' => $this->red * $fact, 'green' => $this->green * $fact, 'blue' => $this->blue * $fact)));
    }
}
?>
