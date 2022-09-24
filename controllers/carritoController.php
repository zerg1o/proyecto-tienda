<?php
require_once("models/producto.php");
class carritoController{


    public function add(){
        //verificar que el id del producto y la cantidad sean datos validos
        if(!empty($_GET['id']) && isset($_GET['id']) && !empty($_POST['cantidad']) && isset($_POST['cantidad'])&&isset($_POST['btn-add-producto'])){

            //verificar si el producto ya existe en el carrito
            if(!isset($_SESSION['carrito'])){
                $_SESSION['carrito']=array();
            }
            $id = $_GET['id'];
            $existe = false;
            foreach($_SESSION['carrito'] as $producto){
                if($producto->id==$id){
                    $existe = true;
                }
            }

            if(!$existe){
                $producto = new Producto();
                $producto->setId($id);
                $pro = $producto->getOne();

                //validando si el id corresponde a un producto
                if(is_object($pro)){
                    
                    //validando cantidad
                    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']):false;

                    if(!(is_int($cantidad)&&($cantidad>0)&&(!empty($cantidad)))){

                        $_SESSION['msj-carrito'] = "El campo cantidad no es válido";
                        //redireccionar a ver el producto
                        header("location:".base_url."producto/ver&id=".$id);
                    }elseif(($cantidad > 4)){

                        $_SESSION['msj-carrito'] = "No puedes comprar más de 4 productos iguales en el mismo pedido";
                        header("location:".base_url."producto/ver&id=".$id);

                    }elseif(($cantidad>$pro->stock)){
                        $_SESSION['msj-carrito'] = "La cantidad excede al stock";
                        //redireccionar a ver el producto
                        header("location:".base_url."producto/ver&id=".$id);
                    }else{

                        //todo ok
                        $pro->cantidad = $cantidad;
                        //agregar el producto al carrito
                        array_push($_SESSION['carrito'],$pro);
                        $_SESSION['msj-carrito'] = "Producto agregado al carrito!!";
                        header("location:".base_url."producto/ver&id=".$id);
                    }

                }else{
                    //en caso el producto_id proporcionado no exista en BD
                    header("location:".base_url);
                }
                

            }else{
                $_SESSION['msj-carrito'] = "El producto ya existe en el carrito!!";
                header("location:".base_url."producto/ver&id=".$id);
            }
            
        }else{
            //si la cantidad o el id son invalidos
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $_SESSION['msj-carrito'] = "El campo cantidad no es válido";
                header("location:".base_url."producto/ver&id=".$id);
            }else{
                //si no existe el campo id entonces redirigir al inicio
                header("location:".base_url);
            }
                
        }
    }

    public function edit(){
        //verificar que el id del producto y la cantidad sean datos validos
        if(!empty($_GET['id']) && isset($_GET['id']) && !empty($_POST['cantidad']) && isset($_POST['cantidad'])&& isset($_POST['btn-add-producto'])){
            
            //obteniendo id del producto
            $id=$_GET['id'];
            
            //agregarlo con la cantidad nueva
            $producto = new Producto();
                $producto->setId($id);
                $pro = $producto->getOne();

                //validando si el id corresponde a un producto
                if(is_object($pro)){
                    
                    //validando cantidad
                    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']):false;

                    if(!(is_int($cantidad)&&($cantidad>0)&&(!empty($cantidad)))){

                        $_SESSION['msj-carrito'] = "El campo cantidad no es válido";
                        //redireccionar a ver el producto
                        header("location:".base_url."producto/ver&id=".$id."&editar=1");
                    }elseif(($cantidad > 4)){

                        $_SESSION['msj-carrito'] = "No puedes comprar más de 4 productos iguales en el mismo pedido";
                        header("location:".base_url."producto/ver&id=".$id."&editar=1");

                    }elseif(($cantidad>$pro->stock)){
                        $_SESSION['msj-carrito'] = "La cantidad excede al stock";
                        //redireccionar a ver el producto
                        header("location:".base_url."producto/ver&id=".$id."&editar=1");
                    }else{

                        //todo ok
                        //eliminando producto
                        for($i=0;$i<count($_SESSION['carrito']); $i++){
                            if($_SESSION['carrito'][$i]->id==$id){
                                array_splice($_SESSION['carrito'],$i,1);
                            }
                        }
                        /**********************************************/

                        $pro->cantidad = $cantidad;
                        //agregar el producto al carrito
                        array_push($_SESSION['carrito'],$pro);
                        $_SESSION['msj-carrito'] = "Cantidad del producto editado!!!";
                        header("location:".base_url."producto/ver&id=".$id."&editar=1");
                    }

                }else{
                    //en caso el producto_id proporcionado no exista en BD
                    header("location:".base_url);
                }

            //********************************/

        }else{
                //si la cantidad o el id son invalidos
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $_SESSION['msj-carrito'] = "El campo cantidad no es válido";
                    header("location:".base_url."producto/ver&id=".$id."&editar=1");
                }else{
                    //si no existe el campo id entonces redirigir al inicio
                    header("location:".base_url);
                }
                    
        }
    }

    public function deleteProducto(){
        if(isset($_GET['id']) && isset($_SESSION['carrito'])){
            $id=$_GET['id'];

            for($i=0;$i<count($_SESSION['carrito']); $i++){
                if($_SESSION['carrito'][$i]->id==$id){
                    array_splice($_SESSION['carrito'],$i,1);
                }
            }
            header("location:".base_url."carrito/ver");

        }else{
            header("location:".base_url);
        }

        
    }

    public function delete(){
        if(isset($_SESSION['carrito'])){
            unset($_SESSION['carrito']);
            
        }
        header("location:".base_url."carrito/ver");
    }

    public function ver(){
        require_once("views/producto/carrito.php");
    }
}