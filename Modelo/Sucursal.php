<?php
	namespace Modelo;
	use Modelo\Direccion as Direccion;



/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class Sucursal
{
	private $id;
	private $nombre;
	private $direccion;
	private $telefono;

	function __construct($nombre='', $direccion='', $telefono=''){
		$this->id= null;
		$this->nombre= $nombre;
		$this->direccion= $direccion;
		$this->telefono= $telefono;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getDireccion()
	{
		return $this->direccion;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setId($newVal)
	{
		$this->id = $newVal;
	}

	

	/**
	 * 
	 * @param newVal
	 */
	public function setDireccion($newVal)
	{
		$this->direccion = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNombre($newVal)
	{
		$this->nombre = $newVal;
	}

	public function setTelefono($newVal)
	{
		$this->telefono = $newVal;
	}

	
}
?>