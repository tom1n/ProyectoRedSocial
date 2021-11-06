<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends Base_model {

	public $nombre;
	public $seudonimo;
	public $edad;
	public $pais = 1;
	public $foto = null;
	public $habilitado = 0;
	public $habilitado_fecha = null;
	public $correo;
	public $clave;
	public $fecha_nacimiento;

	public function __construct($id="", $codigo=false)
	{
		parent::__construct();
		
		$this->setCodigo(true);

		if (!empty($id)) {
			$this->cargar($id, $codigo);
		}
	}

	public function iniciar($args=[])
	{
		$tmp = $this->db
		->where("clave", $args->clave)
		->where("(seudonimo = '{$args->usuario}' 
			or correo = '{$args->usuario}')",
			null, false)
		->get('usuario');


		if ($tmp->num_rows() > 0) {
			$user = $tmp->row();

			$this->session->set_userdata('usuario', [
				'id' => $user->id,
				'nombre' => $user->nombre,
				'alias' => $user->seudonimo
			]);

			return true;
		}

		return false;
	}
}

/* End of file Usuario_model.php */
/* Location: ./application/models/Usuario_model.php */