<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById('menu-button').addEventListener('click', function() {
                const menu = document.getElementById('menu');
                menu.classList.toggle('show-menu');
            });
        });
    </script>
    <style>
        
    /* Estilos para los formularios */
    .form-container {
        padding-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        padding-bottom: 200px;
    }

    .form-container form {
        flex: 1;
        min-width: 45%;
    }

    /* Estilos para pantallas pequeñas */
    @media (max-width: 768px) {
        .form-container {
            flex-direction: column;
        }

        .form-container form {
            min-width: 100%;
        }
    }
    </style>
</head>
<body>
<?php
    include '../conexionBD/conexiondb.php';
    session_start();

    if (!isset($_SESSION['language'])) {
        $_SESSION['language'] = 'es';
    }
    
    require_once('../lenguajes/' . $_SESSION['language'] . '.php');

    if(!isset($_SESSION["idEmpresa"]) && 
        !isset($_SESSION["nombreEmpresa"])) {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    } else if(isset($_GET["idProyecto"])){
        include 'menuEmpresa.php';
        $controlador = new ControladorBD();
        $consulta = "
                SELECT *
                FROM proyectos
                WHERE Identificador = ".$_GET["idProyecto"]."
                ";
        $resultado = $controlador->consulta($consulta);
        
        echo '<main class="content">';
        
        foreach ($resultado as $fila) {
            echo '<h2>'.$translations['detalles_proyecto_nombre'].'</h2><p>';
            echo $fila["Nombre"];
            echo '</p><h2>'.$translations['detalles_proyecto_descripcion'].'</h2><p>';
            echo $fila["Descripcion"];
            $videoId = explode("/", parse_url($fila['urlVideo'], PHP_URL_PATH))[1];
            $embedUrl = "https://www.youtube.com/embed/" . $videoId;  
            echo '</p><br>
                <div class="video-detalles">
                    <iframe src="'.$embedUrl.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>';
            echo '</p><hr>
            <p>'.$translations['detalles_proyecto_accion'].'</p>';
        }

        echo ' 
        <div class="form-container">
            <form action="colaborar.php" method="POST">
                <h3>'.$translations['detalle_proyecto_formulario_colaborar'].'</h3>
                <input type="hidden" name="idProyecto" value="'.$_GET["idProyecto"].'">
                <input type="hidden" name="idEmpresa" value="'.$_SESSION["idEmpresa"].'">
                <input type="submit" value="'.$translations['detalles_proyecto_boton_colaborar'].'">
            </form>

            <form action="descartar.php" method="POST">
                <h3>'.$translations['detalle_proyecto_formulario_descartar'].'</h3>
                <p>'.$translations['detalles_proyecto_motivo'].'</p>
                <input type="hidden" name="idProyecto" value="'.$_GET["idProyecto"].'">
                <input type="hidden" name="idEmpresa" value="'.$_SESSION["idEmpresa"].'">
                <input type="text" name="motivo" required>
                <input type="submit" value="'.$translations['detalles_proyecto_boton_descartar'].'">
            </form>
        </div>
        ';
        
        echo '</main>';
        
    } else {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=dashboardEmpresas.php" /> ';
    }
?>
    
</body>
</html>