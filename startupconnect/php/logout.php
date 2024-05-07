<?php // Borrado de sesion
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
?>
