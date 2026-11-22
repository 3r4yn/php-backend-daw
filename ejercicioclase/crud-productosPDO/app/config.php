<?php 
//Datos de conexion si cambio de server solo se adaptan y listo..
define('SERVER_DB','localhost');
define('DB_USER','root');
define('DB_PASSWD',"");
//Cambiamos la constante con el valor ProductosDB es la base de datos que usaremos en este servidor
define('DATABASE','ProductosDB'); 

//Ejemplo de como quedaria si algun dia contrato un hosting y me dan estos datos..
/*define('SERVER_DB','mysql.mihosting.com');
define('DB_USER','u48213_tienda');
define('DB_PASSWD',"Xk9#mPq2");
define('DATABASE','u48213_productos');
----VENTAJAS --
Mantenimiento: un cambio de servidor se hace en un solo fichero sin tocar ni arriesgar el resto del código.
Seguridad: la contraseña esta en un unico sitio, que puedes proteger o dejar fuera de repositorios como GitHub.
 */
