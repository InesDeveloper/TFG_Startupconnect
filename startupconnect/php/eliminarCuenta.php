<?php
include '../conexionBD/conexiondb.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'es';
}

require_once('../lenguajes/' . $_SESSION['language'] . '.php');

if(isset($_SESSION["idUsuario"]) &&
   isset($_SESSION["nombreUsuario"])) {
    
    $controlador = new ControladorBD();
    
    $consulta = "DELETE FROM Usuarios WHERE Identificador = ".$_SESSION["idUsuario"];

    $resultado = $controlador->consulta($consulta);

    if($resultado) {
            echo $translations['eliminar_cuenta_exito'];
            echo '<meta http-equiv="Refresh" content="2; url=logout.php" /> ';
    } else {
            echo $translations['eliminar_cuenta_fallo'];
            echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
    }
    
} else if(isset($_SESSION["idEmpresa"]) &&
   isset($_SESSION["nombreEmpresa"])) {
 
    $controlador = new ControladorBD();
    
    $consulta = "DELETE FROM Empresas WHERE Identificador = ".$_SESSION["idEmpresa"];

    $resultado = $controlador->consulta($consulta);

    if($resultado) {
            echo $translations['eliminar_cuenta_exito'];
            echo '<meta http-equiv="Refresh" content="2; url=logout.php" /> ';
    } else {
            echo $translations['eliminar_cuenta_fallo'];
            echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
    }
    
} else {
    echo $translations['dashboard_empresa_sin_login'];
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    
}
?>