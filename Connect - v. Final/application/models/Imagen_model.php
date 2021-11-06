<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagen_model extends Base_model {

	public $enlace;
	public $nombre;
	public $activo = 1;
	public $publicacion_id;

	public function __construct($id="", $codigo=false)
	{
		parent::__construct();
		
		$this->setCodigo(true);

		if (!empty($id)) {
			$this->cargar($id, $codigo);
		}
	}

}

/* End of file Imagen_model.php */
/* Location: ./application/models/Imagen_model.php */