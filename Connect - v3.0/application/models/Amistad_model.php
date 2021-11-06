<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amistad_model extends Base_model {

	public $usuario_id;
	public $amigo;
	public $activo = 1;
	
	public function __construct($id="")
	{
		parent::__construct();
		
		$this->setCodigo(false);
		
		if (!empty($id)) {
			$this->cargar($id);
		}
	}

}

/* End of file Amistad_model.php */
/* Location: ./application/models/Amistad_model.php */