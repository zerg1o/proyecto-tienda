<?php
require_once("models/usuario.php");
class usuarioController{
    public function index(){
        echo "controlador=usuario, accion= index";
    }

    public function registro(){
        require_once("views/usuario/registro.php");
    }

    public function login(){
        if(isset($_POST['btn-login'])){
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            //$usuario->setPassword($_POST['password']);
            $verify = $usuario->verifyUser($_POST['password']);
            
            if($verify && is_object($verify)){
                $_SESSION['usuario'] = $verify;
                
                if($verify->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
                
            }else{
                $_SESSION['error_login'] = "Identificacion fallida";
            }
            
        }
        header("location:".base_url);
    }

    public function logout(){
        if($_POST['btn-cerrar-sesion'] && isset($_SESSION['usuario'])){
            unset($_SESSION['usuario']);
        }
        if($_POST['btn-cerrar-sesion'] && isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("location:".base_url);
    }

    public function save(){
        if(isset($_POST['btn-registrar-usuario'])){
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']):false;
            $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']):false;
            $email = isset($_POST['email']) ? trim($_POST['email']):false;
            $password = isset($_POST['password']) ? $_POST['password']:false;

            $errores = array();
            //validacion nombre
            if(!(!empty($nombre) && !preg_match("/[0-9]/",$nombre))){
                $errores['nombre'] = "*El campo nombre no es válido";
            }

            //validacion apellidos
            if(!(!empty($apellidos) && !preg_match("/[0-9]/",$apellidos))){
                $errores['apellidos'] = "*El campo apellidos no es válido";
            }

            //validacion email
            if(!(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL))){
                $errores['email'] = "*El campo email no es válido";
            }

            //validacion password
            if(empty($password)){
                $errores['password'] = "*El campo password no es válido";
            }

            //echo count($errores);die();
            if(count($errores)==0){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                //var_dump($usuario);
                $save = $usuario->save();
                if($save){
                    $_SESSION['register']="Completed";
                }else{
                    $_SESSION['register']="Failed";
                }
                
            }else{
                $_SESSION['errores'] = $errores;
                $_SESSION['register']="Failed";
            }
            header("location:".base_url."usuario/registro");
        }
    }
}