<?php
include '../conexionBD/conexiondb.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'es';
}

require_once('../lenguajes/' . $_SESSION['language'] . '.php');

if(!isset($_SESSION["idEmpresa"]) && // Si existe sesion de empresa para aportar seguridad
   !isset($_SESSION["nombreEmpresa"])) {
    echo $translations['dashboard_empresa_sin_login'];
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
} else {
    $controlador = new ControladorBD();
    
    if (isset($_POST['user']) && 
        isset($_POST['cif']) && 
        isset($_POST['direccion']) && 
        isset($_POST['telefono'])) {

        $nombre = $_POST['user'];
        $cif = $_POST['cif'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        $consulta = "UPDATE Empresas SET Nombre = '".$nombre."', CIF = '".$cif."', Direccion = '".$direccion."', Telefono = '".$telefono."' WHERE Identificador = ".$_SESSION["idEmpresa"];

        $resultado = $controlador->consulta($consulta);

        if($resultado) {
                echo $translations['actualizar_exito'];
                echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
        } else {
                echo $translations['actualizar_fallo'];
                echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
        }
    } else {
        echo $translations['formulario_completar_campos'];
        echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
    }
}
?>