<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'] = array(
	'class'    => 'Sesion',
	'function' => 'verificar_sesion',
	'filename' => 'Sesion.php',
	'filepath' => 'hooks',
	'params'   => array()
);

