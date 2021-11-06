<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->user = $this->session->userdata('usuario');
	}

	public function index()
	{
		$this->output->set_status_header(405, 'Forbidden');
	}

	public function usuario($codigo)
	{
		$user = new Usuario_model($codigo, true);

		if ($user->getPK()) {

			$this->load->view('principal', [
				'vista' => 'perfil/base',
				'user' => $codigo,
				'scripts' => [
					'assets/js/usuario.js',
					'assets/js/perfil.js'
				]
			]);

		} else {
			$this->output->set_status_header(405, 'Forbidden');
		}
	}

	public function get_datos($codigo)
	{
		$user = new Usuario_model($codigo, true);
		$user->id = $user->getPK();

		$data = [
			'usuario' => $user,
			'actual' => $this->user,
			'amigos' => $this->Amistad_model->get_amigos([
				'usuario' => $user->getPK(),
				'confirmada' => 1
			]),
			'publicacion' => $this->Publicacion_model->buscar([
				'usuario' => $user->getPK(),
				'lista' => true
			])
		];

		$this->output->set_output(json_encode($data));
	}
}

/* End of file Perfil.php */
/* Location: ./application/controllers/Perfil.php */