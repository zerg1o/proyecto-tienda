<?php

require_once("models/producto.php");

class productoController{
    public function index(){
        $producto = new Producto();
        $productos_random = $producto->getRandom(6);
        //echo "controlador=producto, accion= index";
        require_once("views/producto/destacados.php");
    }

    public function gestion(){
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAllProductos();

        require_once("views/producto/gestion.php");

    }

    public function ver(){
        //validan id del producto a editar
        $id = isset($_GET['id']) ? $_GET['id']:false;
        if(!empty($id)&&isset($_GET['id'])){

            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            if(is_object($pro)){
                require_once("views/producto/ver.php");
            }else{
                header("location:".base_url);
            }
            

        }else{
            header("location:".base_url);
        }
    }

    public function crear(){
        Utils::isAdmin();
        require_once("views/producto/crear.php");
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST['btn-guardar-producto'])){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre']:false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']:false;
            $precio = isset($_POST['precio']) ? floatval($_POST['precio']):false;
            $stock = isset($_POST['stock']) ? intval($_POST['stock']):false;
            $categoria = isset($_POST['categoria']) ? intval($_POST['categoria']):false;
            $imagen = isset($_FILES['imagen']) ? $_FILES['imagen']:false;
            


            //errores
            $errores = array();

            //validando imagen
            $name_img = $imagen['name'];
            $mimetype = $imagen['type'];
            if(($mimetype != 'image/jpg') && ($mimetype != 'image/png') && ($mimetype != 'image/jpeg') && ($mimetype != 'image/gif')){
                $errores['imagen'] = "El campo imagen no es válido";
            }

            //validacion de nombre
            if(empty($nombre)){
                $errores['nombre'] = "El campo nombre no es válido";
            }

            //validacion descripcion
            if(empty($descripcion)){
                $errores['descripcion'] = "El campo descripcion no es válido";
            }

            //validacion precio
            if(!(is_numeric($precio) && is_float($precio) && $precio>0)){
                $errores['precio'] = "El campo precio no es válido";
            }

            //validacion stock
            if(!(!empty($stock) && $stock >=0 && is_int($stock))){
                $errores['stock'] = "El campo stock no es válido";
            }

            //validacion categoria_id
            if(!(!empty($categoria) && is_int($categoria))){
                $errores['stock'] = "El campo categoria no es válido";
            }
            

            if(count($errores)==0){

                if(!is_dir("uploads/imagenes")){
                    mkdir("uploads/imagenes",0777,true);
                }
                
                move_uploaded_file($imagen['tmp_name'],"uploads/imagenes/".$name_img);

                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);
                $producto->setImagen($name_img);
                $save = $producto->save();
                if($save){
                    $_SESSION['register'] = "Completed";
                }else{
                    $_SESSION['register'] = "Failed";
                }
            }else{
                $_SESSION['errores'] = $errores;
                $_SESSION['register']="Failed";
            }
        }
        header("location:".base_url."producto/crear");

    }


    public function editar(){
        Utils::isAdmin();
        //validan id del producto a editar
        $id = isset($_GET['id']) ? $_GET['id']:false;
        if(!empty($id)){

            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once("views/producto/editar.php");

        }else{
            header("location:".base_url."producto/gestion");
        }
        

    }

    public function update(){
        Utils::isAdmin();
        if(isset($_POST['btn-guardar-producto'])&&isset($_GET['id'])){
            $id = isset($_GET['id']) ? $_GET['id']:false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre']:false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion']:false;
            $precio = isset($_POST['precio']) ? floatval($_POST['precio']):false;
            $stock = isset($_POST['stock']) ? intval($_POST['stock']):false;
            $categoria = isset($_POST['categoria']) ? intval($_POST['categoria']):false;
            $imagen = isset($_FILES['imagen']) ? $_FILES['imagen']:false;
            


            //errores
            $errores = array();

            //validando imagen
            
            $name_img = $imagen['name'];
            $mimetype = $imagen['type'];
            if(($mimetype != 'image/jpg') && ($mimetype != 'image/png') && ($mimetype != 'image/jpeg') && ($mimetype != 'image/gif') && $imagen==false){
                $errores['imagen'] = "El campo imagen no es válido";
            }
            //validacion id
            if(empty($id)){
                $errores['id'] = "El campo id no es válido";
            }
            //validacion de nombre
            if(empty($nombre)){
                $errores['nombre'] = "El campo nombre no es válido";
            }

            //validacion descripcion
            if(empty($descripcion)){
                $errores['descripcion'] = "El campo descripcion no es válido";
            }

            //validacion precio
            if(!(is_numeric($precio) && is_float($precio) && $precio>0)){
                $errores['precio'] = "El campo precio no es válido";
            }

            //validacion stock
            if(!(!empty($stock) && $stock >=0 && is_int($stock))){
                $errores['stock'] = "El campo stock no es válido";
            }

            //validacion categoria_id
            if(!(!empty($categoria) && is_int($categoria))){
                $errores['stock'] = "El campo categoria no es válido";
            }
            

            if(count($errores)==0){

                if(!is_dir("uploads/imagenes")){
                    mkdir("uploads/imagenes",0777,true);
                }
                
                move_uploaded_file($imagen['tmp_name'],"uploads/imagenes/".$name_img);

                $producto = new Producto();
                $producto->setId($id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);
                $producto->setImagen($name_img);
                $update = $producto->editar();
                if($update){
                    $_SESSION['update'] = "Completed";
                }else{
                    $_SESSION['update'] = "Failed";
                }
            }else{
                $_SESSION['errores'] = $errores;
                $_SESSION['update']="Failed";
            }
        }
        header("location:".base_url."producto/editar");
    }

    public function eliminar(){
        Utils::isAdmin();
        //validan id del producto a eliminar
        $id = isset($_GET['id']) ? $_GET['id']:false;
        if(!empty($id)){
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->eliminar();

            if($delete){
                $_SESSION['delete'] = "Completed";
            }else{
                $_SESSION['delete'] = "Failed";
            }
        }else{
            $_SESSION['delete'] = "Failed";
        }
        header("location:".base_url."producto/gestion");
    }
}