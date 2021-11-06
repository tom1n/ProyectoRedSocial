<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amistad_model extends Base_model {

	public $usuario_id;
	public $amigo;
	public $activo = 1;
	public $confirmada = 1;
	
	public function __construct($id="")
	{
		parent::__construct();
		
		$this->setCodigo(false);
		
		if (!empty($id)) {
			$this->cargar($id);
		}
	}

	public function get_amigos($args=[])
	{
		if (isset($args['id'])) {
			$this->db->where('a.id', $args['id']);
		}

		if (elemento($args, 'usuario')) {
			$this->db->where('a.usuario_id', $args['usuario']);
		}

		if (isset($args['confirmada'])) {
			$this->db->where('a.confirmada', $args['confirmada']);
		}

		if (elemento($args, 'termino')) {
			$termino = $args['termino'];

			$this->db->where("(
				b.nombre like '%{$termino}%' or 
				b.alias like '%{$termino}%'
			)");
		}

		$tmp = $this->db
		->select("
			a.*,
			b.nombre,
			b.foto,
			b.alias,
			b.codigo")
		->from("amistad a")
		->join("usuario b", "b.id = a.amigo")
		->where("a.activo", 1)
		->get();

		if (isset($args['_uno'])) {
			return $tmp->row();
		}

		return $tmp->result();
	}

	public function _buscar($args=[])
	{
		$ses = $this->session->userdata('usuario');

		$usuario = $ses['id'];

		if (elemento($args, 'termino')) {
			$termino = $args['termino'];

			$this->db->where("(
				a.nombre like '%{$termino}%' or 
				a.alias like '%{$termino}%'
			)");
		}

		return $this->db
		->select("
			a.*,
			if (b.id is null, 0, 1) as agregado,
			b.id as agregado_id")
		->from("usuario a")
		->join("amistad b", "b.amigo = a.id and b.usuario_id = {$usuario} and b.activo = 1", "left")
		->where("a.habilitado", 1)
		->where("a.id <>", $ses['id'])
		->get()
		->result();
	}
}

/* End of file Amistad_model.php */
/* Location: ./application/models/Amistad_model.php */