<?php
session_start();

require_once 'modelo/Hotel.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';

$ciudad = $_GET['ciudad'];

$ac = AccesoDatos::initModelo();

if ( $ciudad == "Madrid") {
        include 'vistas/listado.php';
    } else {
        include 'vistas/error.php';
    }
