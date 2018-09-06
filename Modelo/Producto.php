<?php
	namespace Modelo;
	
	use Modelo\TipoCerveza as TipoCerveza;
	use Modelo\Foto as Foto;
/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:42
 */
class Producto
{
	private $id;
	private $nombre;
	private $factor;
	private $capacidad;
	private $tipoCerveza;
	private $foto;

	function __construct($nombre='', $factor='0', $capacidad='0', TipoCerveza $tipoCerveza, $rutaFoto=''){

		$this->id= null;
		$this->nombre= $nombre;
		$this->factor= $factor;
		$this->capacidad= $capacidad;
		$this->tipoCerveza= $tipoCerveza;
		$this->foto= $rutaFoto;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getCapacidad()
	{
		return $this->capacidad;
	}

	public function getFactor()
	{
		return $this->factor;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getTipoCerveza()
	{
		return $this->tipoCerveza;
	}

	public function getFoto(){
		return $this->foto;
	}

	public function getFotoDireccion()
	{
		return $this->foto->getDireccion();
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
	public function setCapacidad($newVal)
	{
		$this->capacidad = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setFactor($newVal)
	{
		$this->factor = $newVal;
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
	public function setTipoCerveza($newVal)
	{
		$this->tipoCerveza = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setFoto($newVal)
	{
		$this->foto = $newVal;
	}

	public function setFotoDireccion($newVal)
	{
		$this->foto->setDireccion($newVal);
	}
	
	public function calcularPrecioCapacidad(){
		return $this->pasarLitro() * $this->tipoCerveza->getPrecioLitro();
	}

	public function pasarLitro(){
		return $this->capacidad / 1000;
	}
}
?>