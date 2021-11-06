<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Usuario_model');

		$this->output->set_content_type('application/json');
	}

	public function index()
	{
		$this->output->set_content_type('text/html');

		$scripts = [
			'assets/js/usuario.js',
			'assets/js/sesion.js'
		];

		$this->load->view('principal', [
			'vista' => 'sesion/base',
			'scripts' => $scripts
		]);		
	}

	public function iniciar()
	{
		if ($this->input->method() === 'post') {

			$data = ['exito' => 0];

			$datos = json_decode(file_get_contents('php://input'));

			if ($this->Usuario_model->iniciar($datos)) {
				$data['exito'] = 1;
			} else {
				$data['mensaje'] = 'Usuario o contraseña incorrecta.';
			}

			$this->output->set_output(json_encode($data));

		} else {
			$this->output->set_status_header(405, 'Forbidden');
		}
	}

	public function guardar($id="")
	{
		$data = ['exito' => 0];

		if ($this->input->method() === 'post') {

			$datos = json_decode(file_get_contents('php://input'));

			$user = new Usuario_model($id);

			if ($user->guardar($datos)) {
				$data['exito'] = 1;
				$data['mensaje'] = 'Usuario creado con éxito.';
				
			} else {
				$data['mensaje'] = $user->getMensaje();
			}

			$this->output->set_output(json_encode($data));

		} else {
			$this->output->set_status_header(405, 'Forbidden');
		}
	}

	public function cerrar()
	{
		$this->session->sess_destroy();
		redirect('usuario');
	}
}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */