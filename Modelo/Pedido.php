<?php
namespace Modelo;

use Modelo\Cliente as Cliente;
use Modelo\Sucursal as Sucursal;
use Modelo\LineaPedido as LineaPedido;

use Exception;
/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:42
 */
class Pedido
{
	private $LineasPedidos= array();

	private $id;
	private $sucursal;
	private $titular;
	private $total;
	private $estado;	// 5 Estados: -Creando Pedido -Enviando a la Sucursal -En Proceso -Finalizado -Rechazado
	private $fechaEmitida;

	function __construct(Sucursal $sucursal, Cliente $titular)
	{
		$this->id= null;
		$this->sucursal= $sucursal;
		$this->titular= $titular;
		$this->total= 0;
		$this->estado = 'Creando Pedido';
		$this->fechaEmitida = '';
	}

	public function getId()
	{
		return $this->id;
	}

	public function getLineasPedidos()
	{
		return $this->LineasPedidos;
	}

	public function getTitular()
	{
		return $this->titular;
	}

	public function getSucursal()
	{
		return $this->sucursal;
	}

	public function getTotal()
	{
		return $this->total;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function getFecha()
	{
		return $this->fechaEmitida;
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
	public function setLineasPedidos($newVal)
	{
		$this->LineasPedidos = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTitular($newVal)
	{
		$this->titular = $newVal;
	}


	/**
	 * 
	 * @param newVal
	 */
	public function setSucursal($newVal)
	{
		$this->sucursal = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTotal($newVal)
	{
		$this->total = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setEstado($newVal)
	{
		$this->estado = $newVal;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setFecha($newVal)
	{
		$this->fechaEmitida = $newVal;
	}

	public function agregarLineaPedido(LineaPedido $nuevaLinea){

		$var = false;

		foreach ($this->LineasPedidos as $key => $value) {
			
			if ($value->getProducto()->getId() === $nuevaLinea->getProducto()->getId()) {
				$var = true;
			}
		}

		if(!$var){
			$this->total += $nuevaLinea->getSubtotal();
			$this->LineasPedidos[] = $nuevaLinea;

		}	else{
			throw new Exception("El producto ya fue agregado.");
			
		}
	}

	public function borrarLineaPedido($idProducto){

		$var = false;

		foreach ($this->LineasPedidos as $key => $value) {
			
			if ($value->getProducto()->getId() === $idProducto) {
				
				$this->total -= $value->getSubtotal();

				unset($this->LineasPedidos[$key]);
				$var = true;
			}
		}

		if (!$var) {
			throw new Exception("Producto inexistente en el pedido.");
		}
		
	}

	public function getListaProductos(){

		$listado = array();

		foreach ($this->LineasPedidos as $key => $value) {
			array_push($listado, $value->getProducto());
		}
		
		return $listado;
	}
}
?>