<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion
{
	protected $ci;
	protected $permitidas = [];

	public function __construct()
	{
        $this->ci =& get_instance();

        $this->permitidas = [
        	'principal',
        	'usuario',
        	'/usuario/iniciar',
        	'/usuario/guardar/',
        	'/usuario/habilitar',
        	'/inicio/buscar'
        ];
	}

	
	public function verificar_sesion()
	{
		$ses = $this->ci->session->userdata('usuario');

		if ($ses) {
			# Acceso valido...
		} else {

			if (isset($_SERVER['PATH_INFO'])) {
				$uri = $_SERVER["PATH_INFO"];
			} else {
				$tmp = explode("/", $_SERVER["REQUEST_URI"]);
				$uri = isset($tmp[2]) ? $tmp[2] : null;
			}

			if (empty($uri) || in_array($uri, $this->permitidas)) {
				# Continua ...
			} else {
				redirect('usuario');
			}

		}
	}
}

/* End of file Sesion.php */
/* Location: ./application/hooks/Sesion.php */
