<!DOCTYPE html> <!--Usuario -->
<html lang="es">
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
    
        if(!isset($_SESSION["idUsuario"]) && // Si existe sesion de usuario para aportar seguridad
           !isset($_SESSION["nombreUsuario"])) {
            echo $translations['dashboard_empresa_sin_login'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
        } else {
            include 'menuUsuario.php';
            echo '
                <main class="content">
                    <h2>'.$translations['dashboard_titulo'].'</h2>
                    
                    <div class="articles">
                ';
            $controlador = new ControladorBD();
            $consulta_proyectos = "
                SELECT *
                FROM proyectos
                WHERE fk_Usuarios = ".$_SESSION['idUsuario']."
            ";
            $resultado_proyectos = $controlador->consulta($consulta_proyectos);
            
            if(empty($resultado_proyectos)) {
                echo $translations['dashboard_proyectos_vacios'];
            } else {
                foreach ($resultado_proyectos as $fila) {
                    $consulta2 = "SELECT * FROM Usuarios WHERE Identificador = '".$fila["fk_Usuarios"]."'";
                    $resultado2 = $controlador->consulta($consulta2);

                    foreach ($resultado2 as $fila2) {
                        echo "
                        <a href='detalles.php?idProyecto=".$fila['Identificador']."'>
                            <div class='article'>
                                <div class='info-container'>
                                    <h2 class='title'>".$fila['Nombre']."</h2>
                                    <p class='description'>".$fila['Descripcion']."</p>
                                    <p class='author'>".$translations['proyecto_autor']."".$fila2['Nombre']."</p>
                                </div>
                                <div class='video-container'>
                                    "; 
                                    echo '<iframe width="300" height="200" src="'.$fila['urlVideo'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                    echo "
                                </div>
                            </div>
                        </a>
                    ";
                    }
                }
            }
    
            
            echo '
                    </div>
                </main>
            ';
            //include 'bandejadeEntrada.php';
        }
    ?>
</body>
</html>
