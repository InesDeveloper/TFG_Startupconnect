<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById('menu-button').addEventListener('click', function() {
                const menu = document.getElementById('menu');
                menu.classList.toggle('show-menu');
            });

            $('#sector').change(function() {
                this.form.submit();
            });
        });
    </script>
     <style> 
        main h2 {color: black; text-align: center;}
        form label {color: black;} 
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
    
        if(!isset($_SESSION["idEmpresa"]) && // Si existe sesion de empresa para aportar seguridad
           !isset($_SESSION["nombreEmpresa"])) {
            echo $translations['dashboard_empresa_sin_login'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
        } else {
            include 'menuEmpresa.php';
            echo '
                <main class="content">
                    <h2>'.$translations['dashboard_titulo'].'</h2>
                    
                    <form action="" method="GET">
                        <label for="sector">'.$translations['dashboard_seleccionar_sector'].'</label>
                        <select name="sector" id="sector">
                            <option value="">'.$translations['dashboard_sectores_valor_defecto'].'</option>';
                            
                            $controlador = new ControladorBD();
                            $consulta_sectores = "SELECT * FROM Sector";
                            $resultado_sectores = $controlador->consulta($consulta_sectores);

                            foreach ($resultado_sectores as $sector) {
                                $tipo = $sector['Tipo'];
                                echo '<option value="'.$sector['Tipo'].'"';
                                if(isset($_GET['sector']) && $_GET['sector'] == $sector['Tipo']) {
                                    echo ' selected';
                                }
                                echo '>'.$translations[$tipo].'</option>';
                            }

                        echo '
                        </select>
                    </form>
                    
                    <div class="articles">
                ';
            
            $condicion_sector = '';
            if(isset($_GET['sector']) && !empty($_GET['sector'])) {
                $condicion_sector = "AND s.Tipo = '" . $_GET['sector'] . "'";
            }

            $consulta_proyectos = "
                SELECT p.Identificador as idProyecto, p.fk_Usuarios as idUsuario, p.Nombre as nombre, p.Descripcion as descripcion, p.urlVideo as urlVideo
                FROM proyectos p
                LEFT JOIN descartes d ON p.Identificador = d.fk_Proyecto AND d.fk_Empresa = ".$_SESSION["idEmpresa"]."
                LEFT JOIN colaboraciones c ON p.Identificador = c.fk_Proyecto AND c.fk_Empresa = ".$_SESSION["idEmpresa"]."
                LEFT JOIN Sector s ON p.fk_Sector = s.Identificador
                WHERE d.fk_Proyecto IS NULL AND c.fk_Proyecto IS NULL
                $condicion_sector
            ";
            $resultado_proyectos = $controlador->consulta($consulta_proyectos);
    
            foreach ($resultado_proyectos as $fila) {
                $consulta2 = "SELECT * FROM Usuarios WHERE Identificador = '".$fila["idUsuario"]."'";
                $resultado2 = $controlador->consulta($consulta2);
                
                foreach ($resultado2 as $fila2) {
                    echo "
                    <a href='detallesProyecto.php?idProyecto=".$fila['idProyecto']."'>
                        <div class='article'>
                            <div class='info-container'>
                                <h2 class='title'>".$fila['nombre']."</h2>
                                <p class='description'>".$fila['descripcion']."</p>
                                <p class='author'>".$translations['proyecto_autor']."".$fila2['Nombre']."</p>
                            </div>
                            <div class='video-container'>
                                "; 
                                $videoId = explode("/", parse_url($fila['urlVideo'], PHP_URL_PATH))[1];
                                $embedUrl = "https://www.youtube.com/embed/" . $videoId;
                                echo '<iframe width="300" height="200" src="'.$embedUrl.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                echo "
                            </div>
                        </div>
                    </a>
                ";
                }
            }
            echo '
                    </div>
                </main>
            ';
            include 'bandejadeEntrada.php';
        }
    ?>
</body>
</html>
