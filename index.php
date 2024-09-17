<?php
ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "D:/xampp/htdocs/pos/php_error_log");

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/equipos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/ventas.controlador.php";

require_once "modelos/proveedores.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/equipos.modelo.php";
require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

