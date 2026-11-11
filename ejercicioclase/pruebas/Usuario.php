<?php

class Usuario {

    private $nombre;
    private $apellido;
    private $edad;
//valida datos antes de guardarlos, realmente se modifica y valida el dato antes de guardarlo.
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
//get se usa para consultar y procesar(dar formato preparar la presentacion) datos antes de entregarlos
    public function getNombre(){
        return $this->nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function getApellido(){
        return $this->apellido;
    }

    public function setEdad($edad){
        if($edad<=0){
            echo "Error edad equivocada";
        }else{
            $this->edad = $edad;
        }
        $this->edad = $edad;
    }
    public function getEdad(){
        return $this->edad;
    }
}