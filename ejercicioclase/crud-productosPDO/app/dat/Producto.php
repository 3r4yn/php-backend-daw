<?php
//3º Esto sera el molde que represemta la fila de una tabla dentro de php..

class Producto //cambiamos el nombre de la clase
{
//Y cambiamos los atributos los metodos no.. son genricos
private $codigo;
    private $nombre;
    private $stock;
    private $stock_min;
    private $precio;
    
    
   
// Setter con método mágico (el nombre de la variable) y el valor que recibira..
    public function __set($atributo,$valor){
//property_Exists verifica que el atributo esta declarado (existe)solo hay 5.. 
        if(property_exists($this, $atributo)) { // $this donde buscar y  $atributo que buscar.
            $this->$atributo = $valor;//Ese valor pasa al atributo privado..
        }
    }
// Getter con método mágico
     public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    
}

