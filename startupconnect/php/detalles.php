<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        form {
            padding-top: 20px;
        }
    </style>
    <script>
        $(document).ready(function() {
            document.getElementById('menu-button').addEventListener('click', function() {
                const menu = document.getElementById('menu');
                menu.classList.toggle('show-menu');
            });
        });
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
        
        if(isset($_POST["id"])) {
            $consulta = "DELETE FROM Proyectos WHERE Identificador = ".$_POST["id"];
            $resultado = $controlador->consulta($consulta);
            
            if($resultado) {
                echo $translations['detalles_borrar_proyecto_exito'];
                echo '<meta http-equiv="Refresh" content="2; url=dashboard.php" /> ';
            } else {
                echo $translations['detalles_borrar_proyecto_fallo'];
                echo '<meta http-equiv="Refresh" content="2; url=detalles.php?idProyecto='.$_GET["idProyecto"].'" /> ';
            }
        } else {
            include 'menuUsuario.php';
        
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
                        <iframe width="300" height="200" src="'.$embedUrl.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <form action="#" method="post">
                        <input type="hidden" name="id" value="'.$fila['Identificador'].'">
                        <input type="submit" value="'.$translations['detalles_borrar_proyecto'].'" name="botonBorrar" class="botonBorrar">
                    </form>
                </main>';
            }
        }
        
    } else {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=dashboard.php" /> ';
    }
?>
    
</body>
</html>