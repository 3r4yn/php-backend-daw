<?php
require_once("Usuario.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

   <?php

require_once("Usuario.php");

$usuario = new Usuario();

$usuario->setNombre("pedro");
//$usuario->nombre = "pedro";
$usuario->setApellido("diaz");
$usuario->setEdad(20);
echo $usuario->getNombre();
echo "<br>";
echo $usuario->getApellido();
echo "<br>";
echo $usuario->getEdad();
?>



</body>
</html>