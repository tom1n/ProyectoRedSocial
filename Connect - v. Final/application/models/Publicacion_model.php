<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacion_model extends Base_model {

	public $usuario_id;
	public $nivel_id;
	public $texto = null;
	public $activo = 1;
	public $video = 0;
	public $video_enlace = null;
	public $reaccion = 0;

	public function __construct($id="")
	{
		parent::__construct();
		
		if (!empty($id)) {
			$this->cargar($id);
		}	
	}

	public function get_registro()
	{
		$registro = $this->buscar([
			'_uno' => true,
			'id' => $this->getPK()
		]);

		return [
			'registro' => $registro,
			'imagenes' => $this->get_imagenes()
		];
	}

	public function buscar($args=[])
	{
		if (isset($args['id'])) {
			$this->db->where('a.id', $args['id']);
		}

		if (isset($args['estado'])) {
			$this->db->where('a.nivel_id', $args['estado']);
		}

		if (isset($args['usuario'])) {
			$this->db->where('a.usuario_id', $args['usuario']);

		} else {
			if (isset($args['cuenta'])) {
				$ses = $this->session->userdata('usuario');

				$amigos = $this->Amistad_model->buscar([
					'usuario_id' => $ses['id'],
					'activo' => 1
				]);

				if ($amigos) {
					$tmpAmigos = [$ses['id']];

					foreach ($amigos as $key => $value) {
						$tmpAmigos[] = $value->amigo;
					}

					$this->db->where_in('a.usuario_id', $tmpAmigos);

				} else {
					$this->db->where('a.usuario_id', $ses['id']);
				}
			}
		}

		$tmp = $this->db
		->select('a.*,
			b.nombre as propietario,
			b.foto,
			c.nombre as estado,
			c.icono,
			date_format(a.fecha, "%d/%m/%Y %H:%i") as fecha_publicacion')
		->from('publicacion a')
		->join('usuario b', 'b.id = a.usuario_id')
		->join('nivel c', 'c.id = a.nivel_id')
		->where('a.activo', 1)
		->order_by('a.fecha', 'desc')
		->get();

		if (isset($args['lista'])) {
			$datos = [];

			foreach ($tmp->result() as $key => $row) {
				$tmp = new Publicacion_model($row->id);
				$datos[] = $tmp->get_registro();	
			}

			return $datos;
		} else {
			if (isset($args['_uno'])) {
				return $tmp->row();
			}

			return $tmp->result();
		}
	}

	public function get_imagenes()
	{
		return $this->db
		->where('publicacion_id', $this->getPK())
		->where('activo', 1)
		->get('imagen')
		->result();
	}
}

/* End of file Publicacion_model.php */
/* Location: ./application/models/Publicacion_model.php */