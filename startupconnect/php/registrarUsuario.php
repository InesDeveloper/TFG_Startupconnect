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
    isset($_POST['dni']) &&
    isset($_POST['apellidos']) && 
    isset($_POST['direccion']) && 
    isset($_POST['telefono'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $_POST['user'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $dni = $_POST["dni"];
    
    $consulta = "INSERT INTO Usuarios (Nombre, Apellido, DNI, Email, Direccion, Telefono, Contrasena) VALUES ('".$user."', '".$apellidos."', '".$dni."', '".$email."', '".$direccion."', '".$telefono."', '".$password."');";
    
    $resultado = $controlador->consulta($consulta);
    
    if($resultado) {
            echo $translations['registrar_usuario_exito'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    } else {
            echo $translations['registrar_usuario_fallo'];
            echo '<meta http-equiv="Refresh" content="2; url=crearUsuario.php" /> ';
    }

} else {
    echo $translations['formulario_completar_campos'];
    echo '<meta http-equiv="Refresh" content="2; url=crearUsuario.php" /> ';
}

?>