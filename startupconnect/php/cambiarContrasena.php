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
    
    if (isset($_POST['password']) && 
        isset($_POST['repitepassword'])) {

        $password = $_POST['password'];
        $repitepassword = $_POST['repitepassword'];
        
        if($password == $repitepassword) {
            $consulta = "UPDATE Usuarios SET Contrasena = '".$password."' WHERE Identificador = ".$_SESSION["idUsuario"];
        
            $resultado = $controlador->consulta($consulta);

            if($resultado) {
                    echo $translations['actualizar_contrasena_exito'];
                    echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
            } else {
                    echo $translations['actualizar_contrasena_fallo'];
                    echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
            }
        } else {
            echo $translations['actualizar_contrasena_comprobar_repetida'];
            echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
        }
        
    } else {
        echo $translations['formulario_completar_campos'];
        echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
    }
    
} else if(isset($_SESSION["idEmpresa"]) &&
   isset($_SESSION["nombreEmpresa"])) {
 
    $controlador = new ControladorBD();
    
    if (isset($_POST['password']) && 
        isset($_POST['repitepassword'])) {

        $password = $_POST['password'];
        $repitepassword = $_POST['repitepassword'];
        
        if($password == $repitepassword) {
            $consulta = "UPDATE Empresas SET Contrasena = '".$password."' WHERE Identificador = ".$_SESSION["idEmpresa"];
        
            $resultado = $controlador->consulta($consulta);

            if($resultado) {
                    echo $translations['actualizar_contrasena_exito'];
                    echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
            } else {
                    echo $translations['actualizar_contrasena_fallo'];
                    echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
            }
        } else {
            echo $translations['actualizar_contrasena_comprobar_repetida'];
            echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
        }
        
        
    } else {
        echo $translations['formulario_completar_campos'];
        echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
    }
    
} else {
    echo $translations['dashboard_empresa_sin_login'];
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    
}
?>