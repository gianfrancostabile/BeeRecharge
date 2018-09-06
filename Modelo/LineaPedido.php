<?php
	namespace Modelo;

	use Modelo\Producto as Producto;
/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:42
 */
class LineaPedido
{
	private $id;
	private $id_Pedido;
	private $cantidad;
	private $producto;
	private $subtotal;

	function __construct(Producto $producto, $cantidad='0'){
		$this->id= null;
		$this->id_Pedido = null;
		$this->cantidad= $cantidad;
		$this->producto= $producto;
		$this->calcularSubtotal();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getIdPedido()
	{
		return $this->id_Pedido;
	}

	public function getCantidad()
	{
		return $this->cantidad;
	}

	public function getProducto()
	{
		return $this->producto;
	}

	public function getSubtotal()
	{
		return $this->subtotal;
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
	public function setIdPedido($newVal)
	{
		$this->id_Pedido = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCantidad($newVal)
	{
		$this->cantidad = $newVal;
		$this->calcularSubtotal();
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProducto($newVal)
	{
		$this->producto = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setSubtotal($newVal)
	{
		$this->subtotal = $newVal;
	}

	public function calcularSubtotal(){

		$this->subtotal= $this->producto->getTipoCerveza()->getPrecioLitro() * $this->cantidad;
	}
}
?>