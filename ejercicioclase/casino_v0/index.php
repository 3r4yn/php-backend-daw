<?php
session_start();
$msg = "";
// Cambiar  visitar --> VALOR DE COOKIE
// Cambiar disponible --> VALOR DE SESSION
// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {
  //pregunto ?? si la coockie esta declarada y su valor no es nulo , si es asi su valor es 0 en $visitas
  $visitas = (int) ($_COOKIE['visitas'] ?? 0);

    if(isset($_POST['cantidadini'])){
      $_SESSION['disponible'] = (int) $_POST['cantidadini'];
    }else {
      $visitas++;
      setcookie('visitas', $visitas, time() + 30 * 24 * 60* 60);
      require_once "form_bienvenida.php";
    exit();
    }
}

$disponible = $_SESSION['disponible'];

// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta 
if (isset($_POST["apostar"])) {
    $cantidad=(int) $_POST['cantidad'];
    $tipo = $_POST ['apuesta'];
    $msg = procesarApuesta($cantidad, $_SESSION['disponible'], $tipo);
    $disponible = $_SESSION['disponible'];
 }

  $disponible = $_SESSION['disponible'];

// Si abandona o ya no le queda dinero -------------------------
 if (isset($_POST["dejar"]) || ($_SESSION["disponible"] <= 0) ) {
    if($_SESSION['disponible']<=0){
  $msg .= "Se ha quedado sin dinero.";
    }
  $disponible = $_SESSION['disponible'];
  session_destroy();
  require_once "despedida.php";
   exit();
} 
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int & $saldodisponible, string $apuesta): String {
    if($valorapuesta <= 0){
      return "Debe introducir una cantidad mayor que 0";
    }
    if($valorapuesta > $saldodisponible){
      return "No puedes hacer la apuesta : tu saldo disponible es $saldodisponible € ";
    }
  // GENERO UN PAR O IMPAR
    $numero = random_int(1,100);
    $resultado = ($numero % 2 == 0) ? "PAR" : "IMPAR"; 
    
    if($resultado === $apuesta){
      $saldodisponible += $valorapuesta;
      return "Felicidades a salido el $numero ($resultado). Tu premio es  {$valorapuesta}€";
    }else{
      $saldodisponible -= $valorapuesta;
      return "Ha salido el $numero($resultado). Perdiste {$valorapuesta}€";
    }
}

