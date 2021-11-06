<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Mailjet\Resources;

if (!function_exists('enviar_correo')) {
	function enviar_correo($args=[])
	{
		$result = ['exito' => 0];

		if (elemento($args, 'de') &&
			elemento($args, 'para') &&
			elemento($args, 'asunto') &&
			elemento($args, 'texto')) {

			$mj = new \Mailjet\Client('af50fb5d3b53b4402ed4b191a8d212a1','a8fc1ed7103da06fdbd5520cf7e25e4b',true,['version' => 'v3.1']);
			$body = [
				'Messages' => [
					[
						'From' => [
							'Email' => "soportekupper@gmail.com",
							'Name' => "TunFace"
						],
						'To' => [
							[
								'Email' => $args['para'],
								'Name' => "TunFace"
							]
						],
						'Subject' => $args['asunto'],
						'HTMLPart' => $args['texto'],
						'CustomID' => "AppGettingStartedTest"
					]
				]
			];

			$response = $mj->post(Resources::$Email, ['body' => $body]);
			if ($response->success() == 1) {
				$result['exito']   = 1;
				$result['mensaje'] = 'Correo enviado correctamente.';
			} else {
				$result['mensaje'] = 'Error en envio de correo.';
			}

		} else {
			$result['mensaje'] = 'Faltan datos para enviar correo.';
		}

		return (object) $result;

	}
}