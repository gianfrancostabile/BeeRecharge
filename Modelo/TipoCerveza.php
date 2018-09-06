<?php
	namespace Modelo;

/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */
class TipoCerveza
{

	private $id;
	private $nombre;
	private $descripcion;
	private $precioLitro;

	function __construct($nombre='', $descripcion='', $precioLitro='0'){

		$this->id= null;
		$this->nombre= $nombre;
		$this->precioLitro= $precioLitro;
		$this->descripcion= $descripcion;
	}

	public function getId(){
		return $this->id;
	}

	public function getDescripcion()
	{
		return $this->descripcion;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getPrecioLitro()
	{
		return $this->precioLitro;
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
	public function setDescripcion($newVal)
	{
		$this->descripcion = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNombre($newVal)
	{
		$this->nombre = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPrecioLitro($newVal)
	{
		$this->precioLitro = $newVal;
	}
}
?>