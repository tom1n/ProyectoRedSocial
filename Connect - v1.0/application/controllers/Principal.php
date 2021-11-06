<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function index()
	{
		$this->load->view('principal', ['vista' => 'bienvenida']);		
	}

}

/* End of file Principal.php */
/* Location: ./application/controllers/Principal.php */