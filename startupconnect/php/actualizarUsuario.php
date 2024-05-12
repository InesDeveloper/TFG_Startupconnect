<?php
include '../conexionBD/conexiondb.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'es';
}

require_once('../lenguajes/' . $_SESSION['language'] . '.php');

if(!isset($_SESSION["idUsuario"]) &&
   !isset($_SESSION["nombreUsuario"])) {
    echo $translations['dashboard_empresa_sin_login'];
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
} else {
    $controlador = new ControladorBD();
    
    if (isset($_POST['nombre']) && 
        isset($_POST['apellidos']) &&
        isset($_POST['dni']) && 
        isset($_POST['direccion']) && 
        isset($_POST['telefono'])) {

        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        
        $consulta = "UPDATE Usuarios SET Nombre = '".$nombre."', Apellido = '".$apellidos."', DNI = '".$dni."', Direccion = '".$direccion."', Telefono = '".$telefono."' WHERE Identificador = ".$_SESSION["idUsuario"];
        
        $resultado = $controlador->consulta($consulta);

        if($resultado) {
                echo $translations['actualizar_exito'];
                echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
        } else {
                echo $translations['actualizar_fallo'];
                echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
        }
    } else {
        echo $translations['formulario_completar_campos'];
        echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
    }
}
?>