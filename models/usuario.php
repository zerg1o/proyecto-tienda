<?php

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $img;
    private $db;

    public function __construct(){
        $this->db = conexion::connect();
    }
    

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): self
    {
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos): self
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $this->db->real_escape_string($email);

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = password_hash($this->db->real_escape_string($password),PASSWORD_BCRYPT, ["cost"=>4]);

        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol): self
    {
        $this->rol = $this->db->real_escape_string($rol);

        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img): self
    {
        $this->img = $this->db->real_escape_string($img);

        return $this;
    }

    public function save(){
        $sql = "insert into usuarios values(null,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user',null);";
        $save = $this->db->query($sql);

        $result = false;

        if($save){
            $result= true;
        }

        return $result;
    }

    public function verifyUser($pass){
        $result = false;
        $sql = "select * from usuarios where email='{$this->email}';";
        $resultado = $this->db->query($sql);
        if($resultado && $resultado->num_rows == 1){
            //var_dump($resultado);
            //die();
            $usuario = $resultado->fetch_object();
            $verify = password_verify($pass,$usuario->password);
            //var_dump($verify);
            //die();
            if($verify){
                $result = $usuario;
            }
        }

        return $result;

    }

}