<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reaccion_model extends Base_model {

	public $activo = 1;
	public $publicacion_id;
	public $usuario_id;

	public function __construct($id="", $codigo=false)
	{
		parent::__construct();
		
		$this->setCodigo(false);

		if (!empty($id)) {
			$this->cargar($id, $codigo);
		}
	}

}

/* End of file Reaccion_model.php */
/* Location: ./application/models/Reaccion_model.php */