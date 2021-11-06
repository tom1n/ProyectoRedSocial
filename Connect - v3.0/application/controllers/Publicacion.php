<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->output->set_content_type('application/json');
	}

	public function index()
	{
		die("Forbidden");	
	}

	public function guardar($id="")
	{
		if ($this->input->method() === 'post') {
			$data  = ['exito' => 0];
			$datos = json_decode(file_get_contents('php://input'));

			$plb = new Publicacion_model($id);

			if ($plb->guardar($datos)) {
				$data['exito'] = 1;
				$data['mensaje'] = 'Publicación exitosa.';
				$data['linea'] = $plb->get_registro();
			} else {
				$data['mensaje'] = $plb->getMensaje();
			}

			$this->output->set_output(json_encode($data));
		} else {
			$this->output->set_status_header(405, 'Forbidden');
		}
	}
}

/* End of file Publicacion.php */
/* Location: ./application/controllers/Publicacion.php */