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
        include 'menuUsuario.php';
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
            echo '</p><br>
                <div class="video-detalles">
                    <iframe src="https://www.youtube.com/embed/'.$fila['urlVideo'].'?si=VSObhyrbDxjLJGPy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </main>';
        }
        
    } else {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=dashboard.php" /> ';
    }
?>
    
</body>
</html>