<?php
include '../conexionBD/conexiondb.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'es';
}

require_once('../lenguajes/' . $_SESSION['language'] . '.php');

$controlador = new ControladorBD();
$pasas = false;

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $empresa = isset($_POST['boxempresa']) ? true : false;
    
    $consulta = "";
    if($empresa) {
        $consulta = "SELECT * FROM Empresas WHERE email = '".$email."' AND contrasena = '".$password."'";
    } else {
        $consulta = "SELECT * FROM Usuarios WHERE email = '".$email."' AND contrasena = '".$password."'";
    }
        
    $resultado = $controlador->consulta($consulta);
    
    $idLogeado = "";
    $nombreLogeado = "";
    $imagenPerfil = null;
    foreach ($resultado as $fila) {
//        foreach ($fila as $clave => $valor) {
//            echo $clave . ": " . $valor . "<br>";
//        }
//        echo "<br>";
        
        $pasas = true;
        $idLogeado = $fila['Identificador'];
        $nombreLogeado = $fila['Nombre'];
        $imagenPerfil = $fila['imagenPerfil'];
    }
    
    if($pasas) {    // Si existe el usuario
        if($empresa) { // Si soy empresa
            $_SESSION["idEmpresa"] = $idLogeado; // Almaceno el ID de empresa y el nombre
            $_SESSION["nombreEmpresa"] = $nombreLogeado;
            $_SESSION["imagenPerfil"] = $imagenPerfil;
            
            echo $translations['login_cargando_empresa'];
            echo '<meta http-equiv="Refresh" content="2; url=dashboardEmpresas.php" /> ';
        } else {
            $_SESSION["idUsuario"] = $idLogeado;
            $_SESSION["nombreUsuario"] = $nombreLogeado;
            $_SESSION["imagenPerfil"] = $imagenPerfil;
            
            echo $translations['login_cargando_usuario'];
            echo '<meta http-equiv="Refresh" content="2; url=dashboard.php" /> ';
        }
    } else {
        echo $translations['login_no_usuario'];
        echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    }

} else {
    echo $translations['formulario_completar_campos'];
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
}

?>