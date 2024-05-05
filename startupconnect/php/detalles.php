<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
    /* Estilos para los formularios */
    .form-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
    }

    .form-container form {
        flex: 1;
        min-width: 45%; /* Ajusta el ancho mínimo de los formularios */
    }

    /* Estilos para pantallas pequeñas */
    @media (max-width: 768px) {
        .form-container {
            flex-direction: column; /* Cambia a disposición vertical */
        }

        .form-container form {
            min-width: 100%; /* Formularios ocupan todo el ancho */
        }
    }
    </style>
    <script>
        
    </script>
</head>
<body>
<?php
    include '../conexionBD/conexiondb.php';
    session_start();

    if (!isset($_SESSION['language'])) {
        $_SESSION['language'] = 'es';
    }
    
    require_once('../lenguajes/' . $_SESSION['language'] . '.php');

    if(!isset($_SESSION["idUsuario"]) && 
        !isset($_SESSION["nombreUsuario"])) {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    } else if(isset($_GET["idProyecto"])){
        $controlador = new ControladorBD();
        $consulta = "
                SELECT *
                FROM proyectos
                WHERE Identificador = ".$_GET["idProyecto"]."
                ";
        $resultado = $controlador->consulta($consulta);
        
        foreach ($resultado as $fila) {
            echo '<h2>'.$translations['detalles_proyecto_nombre'].'</h2><p>';
            echo $fila["Nombre"];
            echo '</p><h2>'.$translations['detalles_proyecto_descripcion'].'</h2><p>';
            echo $fila["Descripcion"];
            echo '</p>';
        }
        
    } else {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=dashboard.php" /> ';
    }
?>
    
</body>
</html>