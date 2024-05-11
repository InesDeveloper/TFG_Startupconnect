<?php
include '../conexionBD/conexiondb.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'es';
}

require_once('../lenguajes/' . $_SESSION['language'] . '.php');

if (isset($_SESSION["idUsuario"]) &&
    isset($_POST['nombre']) && 
    isset($_POST['descripcion']) && 
    isset($_POST['urlVideo']) && 
    isset($_POST['fk_sector'])) {

    $idUsuario = $_SESSION["idUsuario"];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $urlVideo = $_POST['urlVideo'];
    $sector = $_POST['fk_sector'];
    
    $controlador = new ControladorBD();
    $consulta = "INSERT INTO Proyectos (fk_Usuarios, Nombre, Descripcion, urlVideo, fk_sector) VALUES ('".$idUsuario."', '".$nombre."', '".$descripcion."', '".$urlVideo."', '".$sector."');";
    
    $resultado = $controlador->consulta($consulta);
    
    if($resultado) {
            echo $translations['registrar_proyecto_exito'];
            echo '<meta http-equiv="Refresh" content="2; url=dashboard.php" /> ';
    } else {
            echo $translations['registrar_proyecto_fallo'];
            echo '<meta http-equiv="Refresh" content="2; url=formularioProyecto.php" /> ';
    }

} else {
    echo $translations['formulario_completar_campos'];
    echo '<meta http-equiv="Refresh" content="2; url=formularioProyecto.php" /> ';
}
?>