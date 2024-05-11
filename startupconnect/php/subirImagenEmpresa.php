<?php

include '../conexionBD/conexiondb.php';
session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'es';
}

require_once('../lenguajes/' . $_SESSION['language'] . '.php');

$userId = $_SESSION['idEmpresa']; // Asumiendo que el ID del usuario está almacenado en la sesión
$target_dir = "../assets/img/perfiles/empresa/"; // Directorio donde se guardará la imagen

// Crear el directorio si no existe
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); // Crear el directorio con permisos de lectura/escritura, recursivamente
}

// Obtener la extensión del archivo original
$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));

// Renombrar el archivo para usar el ID del usuario como nombre de archivo
$target_file = $target_dir . $userId . '.' . $imageFileType;

// Proceso de subida
$uploadOk = 1;

// Verificar si el archivo de imagen es una imagen real o falsa
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
//        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
//        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}

// Verificar si el archivo ya existe
if (file_exists($target_file)) {
    if (unlink($target_file)) {
//        echo "El archivo existente ha sido eliminado.";
    } else {
//        echo "Error al eliminar el archivo existente.";
        $uploadOk = 0;
    }
}

// Verificar el tamaño del archivo
if ($_FILES["fileToUpload"]["size"] > 500000) { // 500 KB como ejemplo
//    echo "Lo siento, tu archivo es demasiado grande.";
    $uploadOk = 0;
}

// Permitir ciertos formatos de archivo
if($imageFileType != "png") {
//    echo "Lo siento, solo archivos PNG";
    $uploadOk = 0;
}

// Verificar si $uploadOk está puesto en 0 por un error
if ($uploadOk == 0) {
    echo "Lo siento, tu archivo no fue subido.";
    echo '<meta http-equiv="Refresh" content="2; url=perfilUsuario.php" /> ';
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "El archivo ". htmlspecialchars($userId) . "." . $imageFileType . " ha sido subido.";
        
        $filePath = $target_file; // Ruta de la imagen subida

        // SQL para insertar la ruta del archivo en la base de datos
        $sql = "UPDATE Empresas SET imagenPerfil = '".$filePath."' WHERE Identificador = ".$userId;
        $controlador = new ControladorBD();
        $resultado = $controlador->consulta($sql);
        
        if($resultado) {
            echo "La imagen de perfil ha sido actualizada en la base de datos.";
            $_SESSION['imagenPerfil'] = $filePath;
            echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
        } else {
            echo "Error al actualizar la imagen de perfil en la base de datos.";
            echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
        }
    } else {
        echo "Lo siento, hubo un error subiendo tu archivo.";
        echo '<meta http-equiv="Refresh" content="2; url=perfilEmpresa.php" /> ';
    }
}

?>
