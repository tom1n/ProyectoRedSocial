<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model {
	protected $_tabla = "";
	protected $_llave = "id";
	protected $_pk = null;
	protected $_codigo = TRUE;
	protected $mensaje = [];
	protected $campos = [];

	public function __construct()
	{
		parent::__construct();
		$this->_tabla = $this->getTabla();
	}

	public function setCampos($valor)
	{
		$this->campos = $valor;
	}

	public function limpiarGeneral()
	{
		$this->_pk = null;
		$this->mensaje = [];
	}

	public function getPK()
	{
		return $this->_pk;
	}

	public function setCodigo($valor)
	{
		$this->_codigo = $valor;
	}

	public function getMensaje()
	{
	    return $this->mensaje;
	}
	
	public function setMensaje($mensaje)
	{
	    $this->mensaje[] = $mensaje;
	    return $this;
	}

	public function setTabla($nombre)
	{
		$this->_tabla = $nombre;

		$tmp = explode(".", $nombre);

		$this->_llave = count($tmp) > 1 ? $tmp[1] : $nombre;
	}

	public function setLlave($nombre)
	{
		$this->_llave = $nombre;
	}

	private function getTabla()
	{
		return str_replace("_model", "", strtolower(get_class($this)));
	}

	public function setDatos($args)
	{
		foreach ($args as $campo => $valor) {
			$tmpCampo = strtolower($campo);

			if (property_exists($this, $campo)) {
				$this->$campo = $valor;
			} else if (property_exists($this, $tmpCampo)) {
				$this->$tmpCampo = $valor;
			}
		}
	}

	public function cargar($valor, $codigo = FALSE)
	{
		if ($codigo) {
			$this->db->where('codigo', $valor);
		} else {
			$this->db->where($this->_llave, $valor);
		}

		$tmp = $this->db
		->get($this->_tabla)
		->row();

		if ($tmp) {
			$var = $this->_llave;
			$this->_pk = $tmp->$var;

			$this->setDatos($tmp);
		}
	}

	public function guardar($args=[])
	{
		$this->setDatos($args);

		$exito = FALSE;

		if ($this->_pk === null) {
			if (empty($this->usuario)) {
				if (property_exists($this, 'usuario')) {
					$this->usuario = verPropiedad($args, "usuario", verDato($_SESSION, "UserID", NULL));
				}
			}

			if (empty($this->empresa)) {
				if (property_exists($this, 'empresa')) {
					$this->empresa = verPropiedad($args, "empresa", verDato($_SESSION, "EmpresaID", NULL));
				}
			}

			if ((property_exists($this, 'usuario') && $this->usuario === NULL) || (property_exists($this, 'empresa') && $this->empresa === NULL)) {
				$this->setMensaje("Es necesario establecer una empresa y usuario para continuar");
				return FALSE;
			}
			
			if ($this->_codigo) {
				$this->db->set("codigo", "uuid_short()", FALSE);
			}

			$this->db->insert($this->_tabla, $this);

			$exito = $this->db->affected_rows() > 0;

			if ($exito) { 
				$this->_pk = $this->db->insert_id(); 
			} else {
				$error = $this->db->error();
				$this->setMensaje($error["message"]);
			}
		} else {
			$this->db
			->where($this->_llave, $this->_pk)
			->update($this->_tabla, $this);

			$exito = $this->db->affected_rows() > 0;

			if (!$exito) {
				$this->setMensaje("Nada que actualizar");
			}
		}

		if ($this->_pk !== null) {
			$this->cargar($this->_pk);
		}

		return $exito;
	}

	public function getUsuario()
	{
		return $this->conf->get_usuario([
			"uno" => true,
			"usuario" => $this->usuario
		]);
	}

	public function buscar($args = [])
	{
		$inicio = $args["_inicio"] ?? 0;
		
		if (isset($args["_limite"])) {
        	$this->db->limit($args["_limite"], $inicio);
        }

        if (isset($args["_like"])) {
        	foreach ($args["_like"] as $campo => $valor) {
        		$this->db->like($campo, $valor);
        	}
        }

        if (isset($args["_in"])) {
        	foreach ($args["_in"] as $campo => $valor) {
        		$this->db->where_in($campo, $valor);
        	}
        }

        if (isset($args["_order"])) {
        	foreach ($args["_order"] as $campo => $valor) {
        		$this->db->order_by($campo, $valor);
        	}
        }

        if (isset($args["_is"])) {
        	foreach ($args["_is"] as $campo => $valor) {
        		$this->db->where("{$campo} is {$valor}");
        	}
        }

        if (isset($args["_is_not"])) {
        	foreach ($args["_is_not"] as $campo => $valor) {
        		$this->db->where("{$campo} is not {$valor}");
        	}
        }

		if (count($args) > 0) {
			foreach ($args as $key => $row) {
				if (substr($key, 0, 1) != "_") {
					$this->db->where($key, $row);
				}
			}	
		}

		if (count($this->campos) > 0) {
			$this->db->select($this->_llave);
			$this->db->select(implode(",", $this->campos));
		}

		$tmp = $this->db->get($this->_tabla);

		if (isset($args['_uno'])) {
			return $tmp->row();
		}

		return $tmp->result();
	}
}

/* End of file Base_model.php */
/* Location: ./application/impala/models/Base_model.php */