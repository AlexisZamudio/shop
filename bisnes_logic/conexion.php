<?php

$user = "oulwelvw";
$password = "KLrj7iEvjsYtX0CXR6_6l_8-WE-wHaG4";
$dbname = "oulwelvw";
$port = "5432";
$host = "isilo.db.elephantsql.com";

/*
$user = "user";
$password = "12345";
$dbname = "shop";
$port = "5432";
$host = "127.0.0.1";
*/
$cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());


class ConexionPGSQL{

    //declaración de variables
    public $host; // para conectarnos a localhost o el ip del servidor de postgres
    public $db; // seleccionar la base de datos que vamos a utilizar
    public $user; // seleccionar el usuario con el que nos vamos a conectar
    public $pass; // la clave del usuario
    public $conexion;  //donde se guardara la conexión
    public $url; //dirección de la conexión que se usara para destruirla mas adelante

    function __construct(){}

    //creación de la función para cargar los valores de la conexión.
    public function cargarValores(){
        $this->host="isilo.db.elephantsql.com";
        $this->db="oulwelvw";
        $this->user= "oulwelvw";
        $this->pass="KLrj7iEvjsYtX0CXR6_6l_8-WE-wHaG4";
        $this->conexion="host='$this->host' dbname='$this->db' user='$this->user' password='$this->pass' ";
    }

    //función que se utilizara al momento de hacer la instancia de la clase
    function conectar()
    {
        $this->cargarValores();
        $this->url=pg_connect($this->conexion);
        return true;
    }

    //función para destruir la conexión.
    function destruir(){
        pg_close($this->url);
    }
}


?>