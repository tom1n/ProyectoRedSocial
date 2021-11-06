<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nivel_model extends Base_model {

	public $nombre;
	public $activo = 1;
	
	public function __construct($id="")
	{
		parent::__construct();
		
		if (!empty($id)) {
			$this->cargar($id);
		}
	}

}

/* End of file Nivel_model.php */
/* Location: ./application/models/Nivel_model.php */