<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->output->set_content_type('application/json');	
	}

	public function index()
	{
		$this->output->set_content_type('text/html');

		$this->load->view('principal', [
			'vista' => 'inicio/base',
			'origen' => 2,
			'scripts' => [
				'assets/js/usuario.js',
				'assets/js/imagen.js',
				'assets/js/publicacion.js'
			]
		]);	
	}

}

/* End of file Principal.php */
/* Location: ./application/controllers/Principal.php */