<?php
require_once("models/pedido.php");
require_once("models/detallepedido.php");
class pedidoController{
    public function index(){
        echo "controlador=usuario, accion= index";
    }

    public function hacer(){
        //echo "controlador=usuario, accion= hacer";
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>0){

            require_once("views/pedido/hacer.php");

        }else{
            header("location:".base_url);
        }
        
    }

    public function add(){
        
        //validar si el boton fue presionado
        if(isset($_POST['btn-guardar-pedido'])){
            $usuario_id = $_SESSION['usuario']->id;
            $provincia = isset($_POST['provincia']) ? trim($_POST['provincia']) : false;
            $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : false;
            $localidad = isset($_POST['localidad']) ? trim($_POST['localidad']) : false;

            //coste
            $datos_carrito = Utils::datosCarrito();

            if(!(!empty($provincia) && !empty($direccion) && !empty($localidad))){
                $_SESSION['errores'] = "Ingrese los datos correctamente";
            }else{
                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setDireccion($direccion);
                $pedido->setLocalidad($localidad);
                $pedido->setCoste($datos_carrito['total']);

                $insert = $pedido->save();
                
                if($insert){
        
                    $detalle = $pedido->insertDetalle();
                    
                    if($detalle){
                        $_SESSION['register'] = "completed";
                    }else{
                        
                        $_SESSION['register'] = "failed";
                    }
                    
                }else{
                    $_SESSION['register'] = "failed";
                    
                    
                }
                header("location:".base_url."pedido/confirmado");

            }
        }else{
            //si no fue presionado el boton retornar a formulario de pedido
            header("location:".base_url."pedido/hacer");
        }
    }

    public function confirmado(){

        if(isset($_SESSION['usuario'])){
            $pedido = new Pedido();
            $pedido->setUsuarioId($_SESSION['usuario']->id);
            $last_pedido = $pedido->getLastPedidoByUser();
            $pedido->setId($last_pedido->id);
            $productos = $pedido->getProductosByPedido();
            require_once("views/pedido/confirmado.php");
        }else{
            header("location:".base_url);
        }

    }

    public function mispedidos(){
        if(isset($_SESSION['usuario'])){
            $pedido = new Pedido();
            $pedido->setUsuarioId($_SESSION['usuario']->id);
            $pedidos = $pedido->getAllByUser();
            require_once("views/pedido/mispedidos.php");
        }else{
            header("location:".base_url);
        }

    }

    public function detalle(){
        if(isset($_SESSION['usuario']) && isset($_GET['id'])){
            $pedido = new Pedido();
            $pedido->setUsuarioId($_SESSION['usuario']->id);
            $pedido->setId($_GET['id']);
            $detalle_pedido = $pedido->getOne();
            $productos = $pedido->getProductosByPedido();
            require_once("views/pedido/detalle.php");
        }else{
            header("location:".base_url."pedido/mispedidos");
        }
    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        require_once("views/pedido/mispedidos.php");
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['btn-cambiar-estado'])){
            $pedido = new Pedido();
            $pedido->setId($_POST['id']);
            $pedido->setEstado($_POST['estado']);
            $update = $pedido->cambiarEstado();
            if($update){
                $_SESSION['estado'] = "completed";
            }else{
                $_SESSION['estado'] = "failed";
            }
            header("location:".base_url."pedido/detalle&id=".$pedido->getId());
        }else{
            header("location:".base_url);
        }
        
    }
}