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
    
    foreach ($resultado as $fila) {
//        foreach ($fila as $clave => $valor) {
//            echo $clave . ": " . $valor . "<br>";
//        }
//        echo "<br>";
        
        $pasas = true;
        $_SESSION["idUsuario"] = $fila['Identificador'];
        $_SESSION["nombreUsuario"] = $fila['Nombre'];
    }
    
    if($pasas) {
        if($empresa) {
            echo $translations['login_cargando_empresa'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
        } else {
            echo $translations['login_cargando_usuario'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
        }
    } else {
        echo $translations['login_no_usuario'];
        echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    }

} else {
    echo "Por favor, complete todos los campos del formulario.";
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
}

?>