<?php
require_once "Vuelo.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    
    private function __construct(){
        // Cambiar le password !!!!!
        try {
            $dsn = "mysql:host=localhost;dbname=Vuelos;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
          
    }

     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }

    /**
     * Vuelos a un destino que tienen al menos las plazas pedidas.
     * @param string $destino
     * @param int $plazas
     * @return Vuelo[] - Tabla de objetos Vuelo ordenados por precio (vacía si no hay)
     */
    public function getVuelosDisponibles(string $destino, int $plazas): array {
        $tvuelos = [];
        $this->stmt = $this->dbh->prepare(
            "SELECT * FROM Vuelos
              WHERE destino = :destino AND asientos_libres >= :plazas
              ORDER BY precio_billete"
        );
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, 'Vuelo');
        $this->stmt->bindValue(':destino', $destino);
        $this->stmt->bindValue(':plazas', $plazas, PDO::PARAM_INT);
        if ($this->stmt->execute()) {
            while ($vuelo = $this->stmt->fetch()) {
                $tvuelos[] = $vuelo;
            }
        }
        return $tvuelos;
    }

    /**
     * Indica si hay algún vuelo a ese destino, tenga o no plazas libres.
     * @param string $destino
     * @return bool
     */
    public function existeDestino(string $destino): bool {
        $this->stmt = $this->dbh->prepare("SELECT COUNT(*) FROM Vuelos WHERE destino = :destino");
        $this->stmt->bindValue(':destino', $destino);
        $this->stmt->execute();
        return $this->stmt->fetchColumn() > 0;
    }



  
}

