<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = conexion::Connect();
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

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    public function setUsuarioId($usuario_id): self
    {
        $this->usuario_id = $this->db->real_escape_string($usuario_id);

        return $this;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia): self
    {
        $this->provincia = $this->db->real_escape_string($provincia);

        return $this;
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($localidad): self
    {
        $this->localidad = $this->db->real_escape_string($localidad);

        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion): self
    {
        $this->direccion = $this->db->real_escape_string($direccion);

        return $this;
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function setCoste($coste): self
    {
        $this->coste = $this->db->real_escape_string($coste);

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado): self
    {
        $this->estado = $this->db->real_escape_string($estado);

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

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora): self
    {
        $this->hora = $this->db->real_escape_string($hora);

        return $this;
    }


    public function save(){

        $sql = "insert into pedidos values(null,{$this->getUsuarioId()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'1',CURDATE(),CURTIME());";
        $insert = $this->db->query($sql);

        return $insert;
    }

    public function insertDetalle(){
        
        $sql = "select LAST_INSERT_ID() as 'pedido_id';";
        $query = $this->db->query($sql);
        $pedido = $query->fetch_object();
    
        foreach($_SESSION['carrito'] as $pro){
            $insert ="insert into detallepedidos values(null,{$pedido->pedido_id},{$pro->id},{$pro->cantidad});";
            $save = $this->db->query($insert);

        }
        
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function getLastPedidoByUser(){
        $sql = "select * from pedidos where usuario_id = {$this->getUsuarioId()} ORDER BY id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getProductosByPedido(){
        $sql = "select PE.id, P.nombre,P.imagen, P.precio, DP.unidades from productos P, detallepedidos DP, pedidos PE
        WHERE PE.usuario_id = {$this->getUsuarioId()} and PE.id = DP.pedido_id and P.id = DP.producto_id and PE.id = {$this->getId()};";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAllByUser(){
        $sql = "select * from pedidos where usuario_id = {$this->getUsuarioId()} order by id desc;";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }

    public function getAll(){
        $sql = "select * from pedidos;";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }

    public function getOne(){
        $sql = "select * from pedidos where id = {$this->getId()};";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function cambiarEstado(){
        $sql = "update pedidos set estado = '{$this->getEstado()}' where id = {$this->getId()};";
        $update = $this->db->query($sql);
        
        return $update;
    }
}

