<?php

class Reloj
{
    private $segundos;
    private $formato24;
    
    public function __construct ( int $hora, int $minutos, int $segundos){
        $this->segundos = ($hora*3600) + ($minutos*60) + $segundos;
        $this->formato24 = true;
    }
    
    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso
    
   public function mostrar(): string {

//Un dia completo tiene 86400 segundos, por lo que 
//si el reloj tiene más de un día completo, se ajusta a la hora del día actual
   $segundosDelDia = $this->segundos % 86400; 
//Si el format24 es verdadero guardara uno de los dos formatos de hora
//H:i:s = formato de 24 horas Y h:i:s a = formato de 12 horas con am/pm
    $formato = $this->formato24 ? "H:i:s" : "h:i:s a";
//devuelve el formato elegdo cn la hora clculada a partir de los segundos del día..
    return gmdate($formato, $segundosDelDia);
    }
    
    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24( bool $formato24){
    $this->formato24 = $formato24;
    }
    
    // Incrementa en un segundo el valor de reloj
    public function tictac (){
    $this->segundos++;
    }
    
    // Comparar Hora, recibe como parámetro otro objeto Reloj
// y me devuelve el número de segundos que tienen de diferencia
    
    public function comparar ( Reloj $otroreloj): int {    
//abs convierte en postivo el resultado por si sale negativo al restar el reloj actual del otro reloj..
    return abs($this->segundos - $otroreloj->segundos);
    }    
}
