<?php
include '../conexionBD/conexiondb.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'es';
}

require_once('../lenguajes/' . $_SESSION['language'] . '.php');

$controlador = new ControladorBD();
$pasas = false;

if (isset($_POST['email']) && 
    isset($_POST['password']) && 
    isset($_POST['user']) && 
    isset($_POST['cif']) && 
    isset($_POST['direccion']) && 
    isset($_POST['telefono'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $_POST['user'];
    $cif = $_POST['cif'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    
    $consulta = "INSERT INTO Empresas (Nombre, CIF, Direccion, Telefono, Email, Contrasena) VALUES ('".$user."', '".$cif."', '".$direccion."', '".$telefono."', '".$email."', '".$password."');";

    $resultado = $controlador->consulta($consulta);

    if($resultado) {
            echo $translations['registrar_empresa_exito'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    } else {
            echo $translations['registrar_empresa_fallo'];
            echo '<meta http-equiv="Refresh" content="2; url=crearUsuario.php" /> ';
    }

} else {
    echo $translations['formulario_completar_campos'];
    echo '<meta http-equiv="Refresh" content="2; url=crearUsuario.php" /> ';
}

?>