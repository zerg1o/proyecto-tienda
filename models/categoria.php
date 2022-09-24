<?php

class Categoria{
    private $id;
    private $nombre;
    public $db;
    public function __construct(){
        $this->db = Conexion::Connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $this->db->real_escape_string($id);

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

    public function getAllCategorias(){
        $sql="select * from categorias;";
        $categorias = $this->db->query($sql);
        return $categorias;
    }

    public function getOne(){
        $sql="select * from categorias where id = {$this->getId()};";
        $categoria = $this->db->query($sql);
        return $categoria->fetch_object();
    }

    public function saveCategoria(){
        $sql = "insert into categorias values(null,'{$this->getNombre()}');";
        $save = $this->db->query($sql);

        $result = false;

        if($save){
            $result= true;
        }

        return $result;
    }
}