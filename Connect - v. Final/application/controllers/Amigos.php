<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amigos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user = $this->session->userdata('usuario');

		$this->output->set_content_type('application/json');
	}

	public function index()
	{
		$this->output->set_content_type('text/html');

		$this->load->view('principal', [
			'opcion' => 2,
			'menu' => 'menu',
			'vista' => 'amistad/base',
			'scripts' => [
				'assets/js/amigo.js'
			]
		]);
	}

	public function get_datos()
	{
		$ses = $this->session->userdata('usuario');

		$data = [
			'usuario' => $this->session->userdata('usuario'),
			'amigos' => $this->Amistad_model->get_amigos([
				'usuario' => $ses['id'],
				'confirmada' => 1
			])
		];

		$this->output->set_output(json_encode($data));
	}

	public function buscar()
	{
		$data = [
			'lista' => $this->Amistad_model->_buscar($_GET)
		];

		$this->output->set_output(json_encode($data));
	}

	public function accion ($id="")
	{

		$data = ['exito' => 0];

		$datos = json_decode(file_get_contents('php://input'));

		$am = new Amistad_model($id);
		$am->activo = $datos->valor;

		if (empty($id)) {
			$am->amigo = $datos->amigo;
		}

		if ($am->guardar()) {
			$data['exito'] = 1;
			$data['reg'] = $am->getPK();
			$data['amigo'] = $am->get_amigos([
				'id' => $am->getPK(),
				'_uno' => true
			]);

		} else {
			$data['mensaje'] = $am->getMensaje();
		}

		$this->output->set_output(json_encode($data));
	}
}

/* End of file Amigos.php */
/* Location: ./application/controllers/Amigos.php */