<?php
class Matrix
{
    const IDENTITY = "IDENTITY";
    const SCALE = "SCALE preset";
    const RX = "Ox ROTATION preset";
    const RY = "Oy ROTATION preset";
    const RZ = "Oz ROTATION preset";
    const TRANSLATION = "TRANSLATION preset";
	const PROJECTION = "PROJECTION preset";
	
    private $_matrix = array(
        array(0.00, 0.00, 0.00, 0.00),
        array(0.00, 0.00, 0.00, 0.00),
        array(0.00, 0.00, 0.00, 0.00),
		array(0.00, 0.00, 0.00, 0.00));
		
    private $_preset;
    private $_scale;
    private $_angle;
    private $_vtc;
    private $_fov;
    private $_ratio;
    private $_near;
	private $_far;
	
	static $verbose = false;
	
    function __construct($kwargs)
    {
        if (isset($kwargs['preset']) && !empty($kwargs['preset'])) {
			$this->_preset = $kwargs['preset'];
            if ($kwargs['preset'] == self::SCALE && isset($kwargs['scale']) && !empty($kwargs['scale'])) {
                $this->_scale = $kwargs['scale'];
            }
			if ($kwargs['preset'] == self::TRANSLATION && isset($kwargs['vtc']) && !empty($kwargs['vtc'])
				&& $kwargs['vtc'] instanceof Vector) {
				$this->_vtc = $kwargs['vtc'];
			}
            if (($kwargs['preset'] == self::RX || $kwargs['preset'] == self::RY || $kwargs['preset'] == self::RZ)
                && isset($kwargs['angle']) && !empty($kwargs['angle'])) {
				$this->_angle = $kwargs['angle'];
            }
            if ($kwargs['preset'] == self::PROJECTION && isset($kwargs['fov']) && !empty($kwargs['fov'])
                && isset($kwargs['ratio']) && !empty($kwargs['ratio'])
                && isset($kwargs['near']) && !empty($kwargs['near'])
                && isset($kwargs['far']) && !empty($kwargs['far'])) {
                $this->_fov = $kwargs['fov'];
                $this->_ratio = $kwargs['ratio'];
                $this->_near = $kwargs['near'];
				$this->_far = $kwargs['far'];
            }
			$this->_createMatrix();
            if (self::$verbose) {
                echo "Matrix " . $kwargs['preset'] . " instance constructed\n";
                $this->__toString();
            }
        }
	}
	
    private function _createMatrix()
    {
        switch ($this->_preset) {
            case (self::IDENTITY):
                $this->_matrix[0][0] = 1.00;
                $this->_matrix[1][1] = 1.00;
                $this->_matrix[2][2] = 1.00;
                $this->_matrix[3][3] = 1.00;
                break;
            case (self::SCALE):
                $this->_matrix[0][0] = $this->_scale;
                $this->_matrix[1][1] = $this->_scale;
                $this->_matrix[2][2] = $this->_scale;
                $this->_matrix[3][3] = 1.00;
                break;
            case (self::RX):
                $this->_matrix[0][0] = 1.00;
                $this->_matrix[1][1] = cos($this->_angle);
                $this->_matrix[1][2] = -sin($this->_angle);
                $this->_matrix[2][1] = sin($this->_angle);
                $this->_matrix[2][2] = cos($this->_angle);
                $this->_matrix[3][3] = 1.00;
                break;
            case (self::RY):
                $this->_matrix[0][0] = cos($this->_angle);
                $this->_matrix[0][2] = sin($this->_angle);
                $this->_matrix[1][1] = 1.00;
                $this->_matrix[2][0] = -sin($this->_angle);
                $this->_matrix[2][2] = cos($this->_angle);
                $this->_matrix[3][3] = 1.00;
                break;
            case (self::RZ):
                $this->_matrix[0][0] = cos($this->_angle);
                $this->_matrix[0][1] = -sin($this->_angle);
                $this->_matrix[1][0] = sin($this->_angle);
                $this->_matrix[1][1] = cos($this->_angle);
                $this->_matrix[2][2] = 1.00;
                $this->_matrix[3][3] = 1.00;
                break;
            case (self::TRANSLATION):
                $this->_matrix[0][0] = 1.00;
                $this->_matrix[1][1] = 1.00;
                $this->_matrix[2][2] = 1.00;
                $this->_matrix[3][3] = 1.00;
                $this->_matrix[0][3] = $this->_vtc->getX();
                $this->_matrix[1][3] = $this->_vtc->getY();
                $this->_matrix[2][3] = $this->_vtc->getZ();
                break;
            case (self::PROJECTION):
				$this->_matrix[0][0] = (1 / tan(0.5 * deg2rad($this->_fov))) / $this->_ratio;
                $this->_matrix[1][1] = 1 / tan(0.5 * deg2rad($this->_fov));
                $this->_matrix[2][2] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
                $this->_matrix[3][2] = -1.00;
                $this->_matrix[2][3] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
                $this->_matrix[3][3] = 0.00;
                break;
        }
	}
	
    function mult(Matrix $rhs)
    {
        $new_matrix = new Matrix(array('preset' => ""));
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $new_matrix->_matrix[$i][$j] += $this->_matrix[$i][0] * $rhs->_matrix[0][$j];
                $new_matrix->_matrix[$i][$j] += $this->_matrix[$i][1] * $rhs->_matrix[1][$j];
                $new_matrix->_matrix[$i][$j] += $this->_matrix[$i][2] * $rhs->_matrix[2][$j];
                $new_matrix->_matrix[$i][$j] += $this->_matrix[$i][3] * $rhs->_matrix[3][$j];
            }
        }
        return ($new_matrix);
	}
	
    function transformVertex(Vertex $vtx)
    {
        $new_vertex = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0));
        $new_vertex->setX(($vtx->getX() * $this->_matrix[0][0]) + ($vtx->getY() * $this->_matrix[0][1]) + ($vtx->getZ() * $this->_matrix[0][2]) + ($vtx->getW() * $this->_matrix[0][3]));
        $new_vertex->setY(($vtx->getX() * $this->_matrix[1][0]) + ($vtx->getY() * $this->_matrix[1][1]) + ($vtx->getZ() * $this->_matrix[1][2]) + ($vtx->getW() * $this->_matrix[1][3]));
        $new_vertex->setZ(($vtx->getX() * $this->_matrix[2][0]) + ($vtx->getY() * $this->_matrix[2][1]) + ($vtx->getZ() * $this->_matrix[2][2]) + ($vtx->getW() * $this->_matrix[2][3]));
        $new_vertex->setW(($vtx->getX() * $this->_matrix[3][0]) + ($vtx->getY() * $this->_matrix[3][1]) + ($vtx->getZ() * $this->_matrix[3][2]) + ($vtx->getW() * $this->_matrix[3][3]));
        return ($new_vertex);
	}
	
    function __toString()
    {
        return (vsprintf("M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\nx | %0.2f | %0.2f | %0.2f | %0.2f\ny | %0.2f | %0.2f | %0.2f | %0.2f\nz | %0.2f | %0.2f | %0.2f | %0.2f\nw | %0.2f | %0.2f | %0.2f | %0.2f", array(
            $this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3],
            $this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3],
            $this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3],
            $this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3])));
	}
	
	static function doc() {
		$file = file_get_contents('Matrix.doc.txt');
		print($file);
	}
	
    function __destruct()
    {
        if (self::$verbose) {
            print("Matrix instance destructed\n");
        }
    }
}
?>