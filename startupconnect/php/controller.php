<?php

// Incluye el modelo para hacer la solicitud a la API de OpenAI
include_once "model.php";

// Recibe el prompt enviado por el usuario
$prompt = $_POST['prompt'];

echo "He enviado: ".$prompt;

// Valida la entrada del usuario
if (isset($prompt) && !empty(trim($prompt))) {
    $generated_text = getGPTResponse($prompt);

  // Mostramos la respuesta del modelo al usuario - Modelo tipo panel
  echo '<div class="alert alert-primary" role="alert">';
  echo "Respuesta: " . $generated_text;
  echo '</div>';
} else {
  // Si el usuario no ha enviado un prompt válido, mostramos un mensaje de error
  echo "Por favor, introduce una consulta válida.";
}

?>