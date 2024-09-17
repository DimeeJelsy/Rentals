<?php

require_once "../controladores/Proveedores.controlador.php";
require_once "../modelos/Proveedores.modelo.php";

class AjaxProveedores{

	/*=============================================
	EDITAR Proveedor
	=============================================*/	

	public $idProveedor;

	public function ajaxEditarProveedor(){

		$item = "id";
		$valor = $this->idProveedor;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR Proveedor
=============================================*/	

if(isset($_POST["idProveedor"])){

	$Proveedor = new AjaxProveedores();
	$Proveedor -> idProveedor = $_POST["idProveedor"];
	$Proveedor -> ajaxEditarProveedor();

}