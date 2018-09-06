<?php
	namespace Modelo;

	use Modelo\Pedido as Pedido;
/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:42
 */
class Envio
{
	private $id;
	private $direccion;
	private $fecha;
	private $horaEmitida;
	private $pedido;

	function __construct($direccion='', $fecha='', $horaEmitida='', Pedido $pedido)
	{
		$this->id= null;
		$this->direccion= $direccion;
		$this->fecha= $fecha;
		$this->horaEmitida= $horaEmitida;
		$this->pedido= $pedido;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getDireccion()
	{
		return $this->direccion;
	}

	public function getFecha()
	{
		return $this->fecha;
	}

	public function getHoraEmitida()
	{
		return $this->horaEmitida;
	}

	public function getPedido()
	{
		return $this->pedido;
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
	public function setFecha($newVal)
	{
		$this->fecha = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setHoraEmitida($newVal)
	{
		$this->horaEmitida = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPedido($newVal)
	{
		$this->pedido = $newVal;
	}

}
?>