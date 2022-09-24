<?php

class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
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
        $this->id = $this->db->real_escape_string($id);

        return $this;
    }

    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    public function setCategoriaId($categoria_id): self
    {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);

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

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);

        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio): self
    {
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock): self
    {
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta): self
    {
        $this->oferta = $this->db->real_escape_string($oferta);

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha): self
    {
        $this->fecha = $this->db->real_escape_string($fecha);

        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): self
    {
        $this->imagen = $this->db->real_escape_string($imagen);

        return $this;
    }

    public function getAllProductos(){
        $sql = "select * from productos;";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAllByCategoria(){
        $sql = "select * from productos where categoria_id = {$this->getCategoriaId()};";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getOne(){
        $sql = "select * from productos where id = {$this->getId()};";
        $producto = $this->db->query($sql);
        return $producto->fetch_object();
    }

    public function getRandom($limit){
        $sql = "select * from productos order by rand() limit $limit ;";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){
        
        $result = false;
        $sql = "insert into productos values(null,{$this->getCategoriaId()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},null,CURDATE(),'{$this->getImagen()}');";
        $save = $this->db->query($sql);

        
        if($save){
            $result = true;
        }

        return $result;

    }

    public function editar(){
        $result = false;
        $sql="update productos set 
        categoria_id = {$this->getCategoriaId()}, 
        nombre = '{$this->getNombre()}',
        descripcion = '{$this->getDescripcion()}',
        precio = {$this->getPrecio()},
        stock = {$this->getStock()}";

        if($this->getImagen()!=null){
            $sql.=", imagen = '{$this->getImagen()}'";
        }

        
        $sql.=" where id = {$this->getId()};";
        

        $update = $this->db->query($sql);
        if($update){
            $result = true;
        }

        return $result;
    }

    public function eliminar(){
        $result = false;
        $sql = "delete from productos where id = {$this->getId()}";
        $delete = $this->db->query($sql);

        if($delete){
            $result = true;
        }
        return $result;
    }
    

}