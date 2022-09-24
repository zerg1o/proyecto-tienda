<?php

class DetallePedido{
    private $id;
    private $pedido_id;
    private $producto_id;
    private $unidades;
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

    public function getPedidoId()
    {
        return $this->pedido_id;
    }

    public function setPedidoId($pedido_id): self
    {
        $this->pedido_id = $this->db->real_escape_string($pedido_id);

        return $this;
    }

    public function getProductoId()
    {
        return $this->producto_id;
    }

    public function setProductoId($producto_id): self
    {
        $this->producto_id = $this->db->real_escape_string($producto_id);

        return $this;
    }

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function setUnidades($unidades): self
    {
        $this->unidades = $this->db->real_escape_string($unidades);

        return $this;
    }



}