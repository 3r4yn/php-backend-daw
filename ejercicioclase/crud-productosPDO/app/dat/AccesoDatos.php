<?php
include_once "app/dat/Producto.php";
//2º Incluimos el archivo con las constantes de la Base de datos
include_once "app/config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 * VERSION 1:  las sentencias precompiladas ser crean en cada función
 */
class AccesoDatos {
    
    private static $modelo = null; //Se guarda el unico objeto
    private $dbh = null; //Se guarda la conexion PDO
    
    
    public static function getModelo(){
        // Si no existe lo crea el acceso de a la BD
//Comprueba si en la misma clase (self) la instancia $modelo aún no existe (es null
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();//crea una conexion que se guarda en $modelo
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton, se accede por getModelo
   
    private function __construct(){
        
        try {
//dsn es la direccion de base de datos:Tipo de BD(mysql), el servidor(host) y(dbname) la base de datos concreta
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            // Creo el objeto PDO estableciendo la conexión a la BD
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            // Si falla genera una excepción
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }   
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;     // Cierro la conexión
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un array de objeto de productos
    public function getProductos ():array {
        $tuser = [];
/* Prepara la consulta para traer todos los productos y guarda la instrucción 
lista para ejecutarse en la variable $stmt_usuarios*/
        $stmt_usuarios  = $this->dbh->prepare("select * from Productos");
//setfetchmode es el formato o configuracion , fetch class un modo que devuelve como (objeto) los datos apartir de la clase Producto
        $stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'Producto');
// Ejecuto la sentencias 
        if ( $stmt_usuarios->execute() ){
            //$tuser = $stmt_usuarios->fetchAll();
//El while se ejecuta hasta que no queden filas..
            while ( $user = $stmt_usuarios->fetch()){
               // añado ese objeto a la tabla
               $tuser[]= $user;
            }
        }
        

        return $tuser;
    }
    
    // Devuelvo un producto o false
    public function getProducto (String $codigo) {
        $user = false;

        $stmt_usuario   = $this->dbh->prepare("select * from Productos where codigo=:codigo");
        $stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'Producto');
//bindparam vincula por referencia(variable) 'codigo' a $codigo
        $stmt_usuario->bindParam(':codigo', $codigo);
        if ( $stmt_usuario->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_usuario->fetch()){
                $user= $obj;
            }
        }
        return $user;
    }
    
    // UPDATE
    public function modProducto($prod):bool{
      
        $stmt_moduser   = $this->dbh->prepare("update Productos set nombre=:nombre, stock=:stock, stock_min=:stock_min, precio=:precio where codigo=:codigo");
        $stmt_moduser->bindValue(':codigo',$prod->codigo);
        $stmt_moduser->bindValue(':nombre',$prod->nombre);
        $stmt_moduser->bindValue(':stock',$prod->stock);
        $stmt_moduser->bindValue(':stock_min',$prod->stock_min);
         $stmt_moduser->bindValue(':precio',$prod->precio);
        $stmt_moduser->execute();
        // El número de filas modificadas debe ser 1
        $resu = ($stmt_moduser->rowCount () == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($prod):bool{
        $stmt_creauser  = $this->dbh->prepare("insert into Productos (codigo,nombre,stock,stock_min,precio) values (?,?,?,?,?)");
        //$stmt_creauser->bindValue(1,$user->login);
        $stmt_creauser->execute( [$prod->codigo, $prod->nombre, $prod->stock, $prod->stock_min, $prod->precio]);
        $resu = ($stmt_creauser->rowCount () == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $codigo):bool {
        $stmt_boruser = $this->dbh->prepare("delete from Productos where codigo =:codigo");
        $stmt_boruser->bindValue(':codigo', $codigo);
        $stmt_boruser->execute();
    //rowcount cuenta
        $resu = ($stmt_boruser->rowCount () == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

