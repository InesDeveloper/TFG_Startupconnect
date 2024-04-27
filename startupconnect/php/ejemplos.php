<?php
include 'conexiondb.php';

$controlador = new ControladorBD();

$resultados = $controlador->consulta("SELECT * FROM Usuarios");

var_dump($resultados);

?>