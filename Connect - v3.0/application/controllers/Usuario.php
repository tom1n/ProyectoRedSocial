<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->output->set_content_type('application/json');
	}

	public function index()
	{
		$ses = $this->session->userdata('usuario');

		if ($ses) {
			redirect('inicio');

		} else {
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
	}

	public function iniciar()
	{
		if ($this->input->method() === 'post') {

			$data = ['exito' => 0];

			$datos = json_decode(file_get_contents('php://input'));

			$user = new Usuario_model();

			if ($user->iniciar($datos)) {
				$data['exito'] = 1;
			} else {
				$data['mensaje'] = $user->getMensaje();
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

			if ($user->validarCuenta($datos)) {

				if (empty($id)) {
					$datos->clave = sha1($datos->clave);
				}
				
				if ($user->guardar($datos)) {
					$data['exito'] = 1;
					$data['mensaje'] = 'Usuario creado con éxito.';
					
					if (empty($id)) {
						$tmp = $user->buscar([
							'id' => $user->getPK(),
							'_uno' => true
						]);
						$base    = base_url("usuario/habilitar/{$tmp->codigo}");
						$mensaje = "Activa tu cuenta en el siguiente enlace:<br><br>";
						$mensaje.="<a href='{$base}' target='_blank'>Abrir enlace</a>";

						enviar_correo([
							'de' => ['rednaxelanyvlek@gmail.com', "TunFace"],
							'para' => $user->correo,
							'asunto' => "Cuenta de usuario TunFace",
							'texto' => $mensaje
						]);
					}
				} else {
					$data['mensaje'] = $user->getMensaje();
				}
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

	public function habilitar($codigo="")
	{	
		if (empty($codigo)) {
			$this->output->set_status_header(404, 'Forbidden');
			die;
		}

		$user = new Usuario_model($codigo, true);

		if ($user->getPK()) {

			$this->output->set_content_type('text/html');
			$this->load->view('principal', [
				'vista' => 'sesion/habilitar',
				'usuario' => $user
			]);

			if ($user->habilitado == 0) {
				$user->guardar([
					'habilitado' => 1,
					'habilitado_fecha' => date('Y-m-d H:i:s')
				]);
			}

		} else {
			$this->output->set_status_header(404, 'Forbidden');
		}
	}
}

/* End of file Usuario.php */
/* Location: ./application/controllers/Usuario.php */