<?php
//iniciando sesion para los usuarios
session_start();
//helpers
require_once("helpers/utils.php");
require_once("autoload.php");
require_once("config/conexion.php");
require_once("config/parameters.php");
require_once("views/layout/header.php");
require_once("views/layout/sidebar.php");

//$controlador = new UsuarioController();
function show_error(){
    $error = new errorController();
    $error->index();
}

if(isset($_GET['controller']) && class_exists($_GET['controller']."Controller")){

    $nombre_controlador = $_GET['controller']."Controller";
    $controlador = new $nombre_controlador();
    if(isset($_GET['action']) && method_exists($controlador,$_GET['action'])){
        $controlador = new $nombre_controlador();
        $action = $_GET['action'];
        $controlador->$action();
        
    }else{
        show_error();
        
    }
}
elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;
    $controlador = new $nombre_controlador();
    $action_default = action_default;
    $controlador->$action_default();

}

else{
    show_error();
}
require_once("views/layout/footer.php");