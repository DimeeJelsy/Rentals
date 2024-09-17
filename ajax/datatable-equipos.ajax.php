<?php

require_once "../controladores/Equipos.controlador.php";
require_once "../modelos/Equipos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class TablaEquipos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE Equipos
  	=============================================*/ 

	public function mostrarTablaEquipos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$Equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor, $orden);	

  		if(count($Equipos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($Equipos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$Equipos[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $Equipos[$i]["id_categoria"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

				/*=============================================
 	 		TRAEMOS PROVEEDOR
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $Equipos[$i]["id_proveedor"];

		  	$proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			if($Equipos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$Equipos[$i]["stock"]."</button>";

  			}else if($Equipos[$i]["stock"] > 11 && $Equipos[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$Equipos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$Equipos[$i]["stock"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$Equipos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$Equipos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$Equipos[$i]["id"]."' codigo='".$Equipos[$i]["codigo"]."' imagen='".$Equipos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 

  			}

		 
		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$Equipos[$i]["codigo"].'",
			      "'.$Equipos[$i]["descripcion"].'",
			      "'.$categorias["categoria"].'",
				  "'.$proveedores["nombre"].'",
			      "'.$stock.'",
			      "'.$Equipos[$i]["precio_compra"].'",
			      "'.$Equipos[$i]["precio_venta"].'",
			      "'.$Equipos[$i]["fecha"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}



}

/*=============================================
ACTIVAR TABLA DE Equipos
=============================================*/ 
$activarEquipos = new TablaEquipos();
$activarEquipos -> mostrarTablaEquipos();

