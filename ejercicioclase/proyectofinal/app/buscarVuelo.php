<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';


$plazas = $_GET['plazas'];
$destino = $_GET['destino'];

if ( !(is_numeric($plazas) && $plazas > 0 && $plazas <= 5) ) {
    $mensajeError = "ERROR: El N.º de plazas no es correcto, debe ser entre 1 y 5";
    include 'vistas/error.php';
    die();
}

$ac = AccesoDatos::initModelo();

if ( $destino == "Madrid") {
        include 'vistas/listado.php';
    } else {
        include 'vistas/error.php';
    }




 
