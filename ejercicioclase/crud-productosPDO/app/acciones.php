<?php
require_once "app/dat/Producto.php";
require_once 'app/dat/AccesoDatos.php';

function accionBorrar ($codigo){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarProducto($codigo);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}
 
function accionAlta(){
    $user = new Producto();
    $user->codigo  = "";
    $user->nombre   = "";
    $user->stock   = "";
    $user->stock_min = "";
    $user->precio = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($codigo){
    $db = AccesoDatos::getModelo();
    $user = $db->getProducto($codigo);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($codigo){
    $db = AccesoDatos::getModelo();
    $user = $db->getProducto($codigo);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    $user = new Producto();
    $user->codigo  = $_POST['codigo'];
    $user->nombre   = $_POST['nombre'];
    $user->stock   = $_POST['stock'];
    $user->stock_min = $_POST['stock_min'];
    $user->precio = $_POST['precio'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($user);
    
}

function accionPostModificar(){
    
    $user = new Producto();
    $user->codigo  = $_POST['codigo'];
    $user->nombre   = $_POST['nombre'];
    $user->stock   = $_POST['stock'];
    $user->stock_min = $_POST['stock_min'];
    $user->precio = $_POST['precio'];
    $db = AccesoDatos::getModelo();
    $db->modProducto($user);
    
}

