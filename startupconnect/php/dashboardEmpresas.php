<!DOCTYPE html>
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

            $('#sector').change(function() {
                this.form.submit();
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
    
        if(!isset($_SESSION["idEmpresa"]) && 
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
                SELECT p.Identificador as idProyecto, p.fk_Usuarios as idUsuario, p.Nombre as nombre, p.Descripcion as descripcion
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
                            <h2 class='title'>".$fila['nombre']."</h2>
                            <p class='description'>".$fila['descripcion']."</p>
                            <p class='author'>".$translations['proyecto_autor']."".$fila2['Nombre']."</p>
                        </div>
                    </a>
                ";
                }
            }
            echo '
                    </div>
                </main>
            ';
            include 'noticias.php';
        }
    ?>
</body>
</html>
