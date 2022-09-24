<?php

class Utils{
    public static function deleteSesion($name){

        if(isset($_SESSION[$name])){
            $_SESSION[$name]=null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function mostrarErrores($errores,$campo){
        $alerta ="";
        if(!empty($errores[$campo])){
            $alerta.='<div class="alerta alerta-error">'.$errores[$campo].'</div>';
        }
        return $alerta;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("location:".base_url);
        }
    }

    public static function showCategorias(){
        require_once("models/categoria.php");
        $categoria = new Categoria();
        return $categoria->getAllCategorias();
    }

    public static function datosCarrito(){
        $datos=array(
            "num_productos"=> 0,
            "total"=>0
        );

        if(isset($_SESSION['carrito'])){
            $datos['num_productos'] = count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $producto){
                $datos['total']+= ($producto->precio * $producto->cantidad);
            }

        }

        return $datos;
    }

    public static function getEstado($estado){
        $cadena=false;
        if($estado == "confirmado"){
            $cadena = "Confirmado";
        }elseif($estado == "aprobado"){
            $cadena = "Pago aprobado";
        }elseif($estado == "preparado"){
            $cadena = "Preparado para enviar";
        }elseif($estado == "enviado"){
            $cadena = "Enviado";
        }elseif($estado == "reembolsado"){
            $cadena = "Reembolsado";
        }elseif($estado == "entregado"){
            $cadena = "Entregado";
        }else{
            $cadena = "Fallo";
        }
        return $cadena;
    }

}