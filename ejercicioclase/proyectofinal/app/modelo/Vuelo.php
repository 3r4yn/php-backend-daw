<?php

/*
 * Representa una fila de la tabla Vuelos.
 * Los atributos se llaman igual que las columnas para poder usar PDO::FETCH_CLASS
 */
class Vuelo {
    private string $cod_vuelo;
    private string $destino;
    private string $aerolinea;
    private int $clase;
    private float $precio_billete;
    private int $asientos_libres;

    public function __get(String $name)
}
