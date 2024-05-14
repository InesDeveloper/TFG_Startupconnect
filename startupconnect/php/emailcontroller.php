<?php

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];

// Valida la entrada del usuario
if (isset($nombre) && isset($apellidos) && isset($email) && isset($telefono) && isset($mensaje)) {
    
    $destinatario = "inesykiara@gmail.com"; 
    $asunto = "Formulario de contacto"; 
    $cuerpo = $mensaje;
    $headers .= "From: ".$nombre." ".apellidos."  <".$email.">\r\n"; 
    mail($destinatario,$asunto,$cuerpo,$headers);
        
  echo '<div class="alert alert-primary" role="alert">';
  echo "Mensaje enviado";
  echo '</div>';
} else {
  echo "Por favor, rellene todos los campos del formulario.";
}

?>