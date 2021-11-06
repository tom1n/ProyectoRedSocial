<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends Base_model {

	public $nombre;
	public $correo;
	public $alias;
	public $clave;
	public $pais = 1;
	public $fecha_nacimiento;
	public $habilitado = 0;
	public $habilitado_fecha = null;
	public $foto = "https://scontent.fgua9-1.fna.fbcdn.net/v/t1.30497-1/143086968_2856368904622192_1959732218791162458_n.png?_nc_cat=1&ccb=1-5&_nc_sid=7206a8&_nc_ohc=VmoUYsvkMUAAX_Td7iX&_nc_ht=scontent.fgua9-1.fna&oh=2af7f576e73fbbc491285da14072ed9d&oe=61920478";
	public $edad;

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
		->where("clave", sha1($args->clave))
		->where("(alias = '{$args->usuario}' 
			or correo = '{$args->usuario}')",
			null, false)
		->get('usuario');


		if ($tmp->num_rows() > 0) {
			$user = $tmp->row();

			if ($user->habilitado == 0) {
				$this->setMensaje('Ingrese a su correo y confirme su identidad.');

			} else {
				$this->session->set_userdata('usuario', [
					'id' => $user->id,
					'foto' => $user->foto,
					'nombre' => $user->nombre,
					'alias' => $user->alias,
					'codigo' => $user->codigo
				]);

				return true;
			}
		} else {
			$this->setMensaje('Usuario o contraseña incorrecta.');
		}

		return false;
	}

	public function validarCuenta($args=[])
	{
		$ide = $this->getPK();

		if ($ide) {
			$this->db->where('id <>', $ide);
		}

		$tmp = $this->db
		->where("(correo = '{$args->correo}' or alias = '{$args->alias}')", null, false)
		->get('usuario');

		if ($tmp->num_rows() > 0) {
			$tmp = $tmp->row();

			if ($tmp->correo == $args->correo) {
				$this->setMensaje('El correo ya se encuentra registrado.');
			} else if ($tmp->alias == $args->alias) {
				$this->setMensaje('El alias o nombre de usuario ya se encuentra registrado.');
			}

			return false;
		}

		return true;
	}
}

/* End of file Usuario_model.php */
/* Location: ./application/models/Usuario_model.php */