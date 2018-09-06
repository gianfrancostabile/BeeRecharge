<?php
namespace Dao\BD;

use Config\SingleTon as SingleTon;
use Dao\Conexion as Conexion;
use Dao\IDAO as IDAO;
use Modelo\Cuenta as Cuenta;
use Modelo\Cliente as Cliente;

use Dao\BD\DaoBDCliente as DaoCliente;
use Dao\BD\DaoBDTipoUsuario as DaoTipoUsuario;

use Exception;


/**
 * @author gianf
 * @version 1.0
 * @created 11-oct.-2017 10:54:43
 */


class DaoBDCuenta extends SingleTon implements IDAO
{

	//Se le pasa un Objeto Pedido a insertar
	public function insertar($newVal){

		$daoCliente= DaoCliente::getInstance();
		$idCliente = $daoCliente->insertar($newVal->getPersona());

		if ($idCliente != 0) {
			
			$daoTipoUsuario = DaoTipoUsuario::getInstance();
			$idTipoUsuario = $daoTipoUsuario->buscar($newVal->getTipoUsuario());
			
			$query= 'INSERT INTO Cuentas (email, contrasenia, foto_Perfil, id_Cliente, id_Tipo_Usuario) 
			VALUES (:email, :contrasenia, :fotoPerfil, :idCliente, :idTipoUsuario)';

			try{
				$conexion= Conexion::conectar();
				$comando= $conexion->prepare($query);

				$email= $newVal->getEmail();
				$contrasenia= $newVal->getContrasenia();
				$fotoPerfil= $newVal->getFotoPerfil();

				$comando->bindParam(':email', $email);
				$comando->bindParam(':contrasenia', $contrasenia);
				$comando->bindParam(':fotoPerfil', $fotoPerfil);
				$comando->bindParam(':idTipoUsuario', $idTipoUsuario);
				$comando->bindParam(':idCliente', $idCliente);

				$comando->execute();
			}	catch(Exception $e){
				throw new Exception("No se pudo Conectar a la Base de Datos");

			}

			return $conexion->lastInsertId();

		}	else {
			
			throw new Exception("Error en la Base de Datos Cliente");
		}
	}

	//se le pasa el ID de Cuenta a borrar
	public function borrar($newVal){

		$query= 'DELETE FROM Cuentas 
		WHERE id_Usuario= :idCuenta';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$id= $newVal;

			$comando->bindParam(':idCuenta', $id);

			$comando->execute();

		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	public function modificar($idModif, $newVal){

		$query= 'UPDATE Cuentas 
		SET email= :email, contrasenia= :contrasenia, foto_Perfil= :fotoPerfil, id_Cliente= :idCliente
		WHERE id_Usuario= :idModif';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$email= $newVal->getEmail();
			$contrasenia= $newVal->getContrasenia();
			$fotoPerfil= $newVal->getFotoPerfil();
			$idCliente= $newVal->getPersona()->getId();

			$id_Cliente_Modif= $idModif;

			$comando->bindParam(':email', $email);
			$comando->bindParam(':contrasenia', $contrasenia);
			$comando->bindParam(':fotoPerfil', $fotoPerfil);
			$comando->bindParam(':idCliente', $idCliente);

			$comando->bindParam(':idModif', $id_Cliente_Modif);

			$comando->execute();
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}
	}

	//se pasa el Email para buscar una Cuenta
	public function buscar($newVal){
		
		$Cuenta= null;


		$query= 'SELECT * 
		FROM Cuentas 
		WHERE email= :email';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);

			$comando->bindParam(':email', $newVal);

			$comando->execute();

			if($row = $comando->fetch()){

				$daoCliente= DaoBDCliente::getInstance();
				$daoTipoUsuario = DaoTipoUsuario::getInstance();

				$cliente= $daoCliente->buscar($row['id_Cliente']);
				$tipoUsuario = $daoTipoUsuario->getTipoUsuario($row['id_Tipo_Usuario']);


				if(!is_null($cliente)){
					$Cuenta= new Cuenta($cliente, $row['email'], $row['contrasenia'], $row['foto_Perfil']);
					$Cuenta->setTipoUsuario($tipoUsuario);
					$Cuenta->setId($row['id_Usuario']);

				}	else {
					throw new Exception("El Cliente no existe...");

				}

			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $Cuenta;
	}

	// si coinciden tanto contrasenia como email.. devuelve el objeto cuenta.
	public function buscarCuentaLogin($email, $contrasenia){

		$cuenta= null;

		$cuenta= $this->buscar($email);
		
		if(!is_null($cuenta)){

			if($contrasenia !== $cuenta->getContrasenia()){
				throw new Exception("Constraseña erronea...");
				
			}

		}	else {
			throw new Exception("Email Inexistente...");

		}

		return $cuenta;
	}

	public function getAllCuentas(){

		$listado= array();

		$query= 'SELECT * 
		FROM Cuentas';

		try{
			$conexion= Conexion::conectar();
			$comando= $conexion->prepare($query);
			
			$comando->execute();
			
			while($row = $comando->fetch()){

				$DaoCliente= DaoBDCliente::getInstance();
				$Cliente= $DaoCliente->buscar($row['id_Cliente']);

				$Cuenta= new Cuenta($Cliente, $row['email'], $row['contrasenia'], $row['foto_Perfil']);

				$Cuenta->setId($row['id_Usuario']);

				array_push($listado, $Cuenta);
			}
		}	catch(Exception $e){
			throw new Exception("No se pudo Conectar a la Base de Datos");
			
		}

		return $listado;
	}

}
?>