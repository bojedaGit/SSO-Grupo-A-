<?php 
$host = 'sql202.byetcluster.com';
$user = 'b3_41486874'; 
$password = 'IPSLED22mp55';
$db = 'b3_41486874_clinicaOdontologa'; 

$conexion = new mysqli($host, $user, $password, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

$resultado = $conexion->query("SELECT * FROM `clienteHistorial`");




