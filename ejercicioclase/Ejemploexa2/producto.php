<?php
// Entidad Producto: representa una fila de la tabla Productos de la BD.
// Es el "molde": PDO (en AccesoDatos, con FETCH_CLASS) crea un objeto Producto por cada fila.
// Los atributos se llaman IGUAL que las columnas del CREATE TABLE.
    class Producto{
        private $producto_no;
        private $descripcion;
        private $precio_actual;
        private $stock_disponible;
//ESTAS 2 FUNCIONES POR LO GENERAL NUNCA CAMBIAN SON IGUAL EN CUALQUIER CLASE..
// Son métodos mágicos: PHP los llama SOLO, nunca se llaman a mano.
//Get para obtener el valor del atributo escrito que tenemos en la variable de esta clase 
        public function __get($atributo){
//property_Exists pregunta si este objeto(this) tiene un ($atributo) con este nombre..
        if(property_exists($this,$atributo)){
            return $this->$atributo;
        }
        }
// __set: PHP lo llama al ESCRIBIR un atributo privado desde fuera (ej: $pro->precio_actual = 100)
        public function __set($atributo, $valor){
        if(property_exists($this, $atributo)){
            $this->$atributo = $valor;
        }

        }
    
        }
?>