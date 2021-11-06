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
			'vista' => 'inicio/base',
			'opcion' => 1,
			'origen' => 1,
			'scripts' => [
				'assets/js/usuario.js',
				'assets/js/imagen.js',
				'assets/js/publicacion.js'
			]
		]);		
	}

	public function buscar()
	{
		$_GET['lista'] = true;

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