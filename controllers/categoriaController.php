<?php
require_once("models/categoria.php");
require_once("models/producto.php");
class categoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAllCategorias();
        require_once("views/categoria/index.php");
    }

    public function crear(){
        Utils::isAdmin();
        require_once("views/categoria/crear.php");
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //obtener categoria con el id que llega por el get
            $categoria = new Categoria();
            $categoria->setId($id);
            $cat = $categoria->getOne();

            //verificar que el id de la categoria exista en la BD
            if(is_object($cat) && $cat!=null){
                //obtener productos con dicha categoria
                $producto = new Producto();
                $producto->setCategoriaId($id);
                $productos = $producto->getAllByCategoria();
                require_once("views/categoria/ver.php");
            }else{
                header("location:".base_url);
            }
            

        }
    }


    public function save(){
        Utils::isAdmin();
        if(isset($_POST['btn-guardar-categoria'])){

            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
            $errores = array();
            
            //validando nombre
            if(empty($nombre)){
                $errores['nombre'] = "El campo nombre no es válido";
            }

            if(count($errores)==0){
                $categoria = new Categoria();
                $categoria->setNombre($nombre);
                $result = $categoria->saveCategoria();
                if($result){
                    $_SESSION['register'] = "Completed";
                }else{
                    $_SESSION['register'] = "Failed";
                }
            }else{
                $_SESSION['errores'] = $errores;
                $_SESSION['register'] = "Failed";
            }
            
        }

        header("location:".base_url."categoria/crear");
    }
}