<?php

class conexion{
    public static function connect(){
        $conexion = new mysqli("localhost","root","","tienda_master");
        $conexion->query("set names 'utf8'");
        return $conexion;
    }
}