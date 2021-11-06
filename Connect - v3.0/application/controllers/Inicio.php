<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('principal', [
			'menu' => 'inicio/menu',
			'vista' => 'inicio/base',
			'origen' => 1,
			'scripts' => [
				'assets/js/publicacion.js'
			]
		]);		
	}

	public function buscar()
	{
		$ses = $this->session->userdata('usuario');

		if (elemento($_GET, 'origen') == 2) {
			$_GET['estado'] = 3;
		} else {
			$_GET['cuenta'] = true;
		}

		$datos = [
			'nivel' => $this->Nivel_model->buscar(),
			'lista' => $this->Publicacion_model->buscar($_GET)
		];

		$this->output->set_output(json_encode($datos));
	}
}

/* End of file Inicio.php */
/* Location: ./application/controllers/Inicio.php */