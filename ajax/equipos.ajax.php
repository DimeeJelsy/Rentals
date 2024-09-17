<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxEquipos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoEquipos(){

  	$item = "id_categoria";
  	$valor = $this->idCategoria;
    $orden = "id";

  	$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR Equipos
  =============================================*/ 

  public $idEquipos;
  public $traerEquipos;
  public $nombreEquipos;

  public function ajaxEditarEquipos(){

    if($this->traerEquipos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreEquipos != ""){

      $item = "descripcion";
      $valor = $this->nombreEquipos;
      $orden = "id";

      $respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idEquipos;
      $orden = "id";

      $respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["idCategoria"])){

	$codigoEquipos = new AjaxEquipos();
	$codigoEquipos -> idCategoria = $_POST["idCategoria"];
	$codigoEquipos -> ajaxCrearCodigoEquipos();

}
/*=============================================
EDITAR Equipos
=============================================*/ 

if(isset($_POST["idEquipos"])){

  $editarEquipos = new AjaxEquipos();
  $editarEquipos -> idEquipos = $_POST["idEquipos"];
  $editarEquipos -> ajaxEditarEquipos();

}

/*=============================================
TRAER Equipos
=============================================*/ 

if(isset($_POST["traerEquipos"])){

  $traerEquipos = new AjaxEquipos();
  $traerEquipos -> traerEquipos = $_POST["traerEquipos"];
  $traerEquipos -> ajaxEditarEquipos();

}

/*=============================================
TRAER Equipos
=============================================*/ 

if(isset($_POST["nombreEquipos"])){

  $traerEquipos = new AjaxEquipos();
  $traerEquipos -> nombreEquipos = $_POST["nombreEquipos"];
  $traerEquipos -> ajaxEditarEquipos();

}






