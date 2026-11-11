<?php
/*
 * Prueba de la clase Reloj
 */
include_once 'Reloj.php';

$r1 = new Reloj(20,10,10);
$r2 = new Reloj(20,10,15);//empieza con 5 segundos mas

echo " <br> Reloj nº 1 ". $r1->mostrar();
echo " <br> Reloj nº 2 ". $r2->mostrar();
// el reloj r1 esta a la misma hora que r2..
for ($i=1; $i<= 5; $i++){
    $r1->tictac();
}
//compara ambos relojs
if ( $r1->comparar($r2) == 0){
    echo " <br> Están en la misma hora <br>";
}
//hacemos el cambio de formato a 12 horas..
$r1->cambiarFormato24(false);
$r2->cambiarFormato24(false);

echo " <br> Reloj nº 1 ". $r1->mostrar();
echo " <br> Reloj nº 2 ". $r2->mostrar();

// Incremento la hora en una serie de segundos en reloj 1 y reloj2

for ($i=1; $i<= 50000; $i++){
    $r1->tictac();
}

for ($i=1; $i<= 100000; $i++){
    $r2->tictac();
}

echo "<br> Los relojes se diferencias en ". $r1->comparar($r2) .
         " segundos <br> ";

$r1->cambiarFormato24(true);
$r2->cambiarFormato24(true);

echo " <br> Reloj nº 1 ". $r1->mostrar();
echo " <br> Reloj nº 2 ". $r2->mostrar();
