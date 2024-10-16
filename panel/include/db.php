<?php

$conx = new mysqli("localHost", "root", "", "primer_base_de_datos");

if($conx->connect_error){
    die("Conexion fallida". $conx->connect_error);
}

?>