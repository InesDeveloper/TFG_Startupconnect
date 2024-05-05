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
                    <div class="articles">
                ';
            $controlador = new ControladorBD();
            $consulta = "
                SELECT *
                FROM proyectos p
                LEFT JOIN descartes d ON p.Identificador = d.fk_Proyecto AND d.fk_Empresa = ".$_SESSION["idEmpresa"]."
                LEFT JOIN colaboraciones c ON p.Identificador = c.fk_Proyecto AND c.fk_Empresa = ".$_SESSION["idEmpresa"]."
                WHERE d.fk_Proyecto IS NULL AND c.fk_Proyecto IS NULL
            ";
            $resultado = $controlador->consulta($consulta);
    
            foreach ($resultado as $fila) {
                $consulta2 = "SELECT * FROM Usuarios WHERE Identificador = '".$fila["fk_Usuarios"]."'";
                $resultado2 = $controlador->consulta($consulta2);
                
                foreach ($resultado2 as $fila2) {
                    echo "
                    <div class='article'>
                        <h2 class='title'>".$fila['Nombre']."</h2>
                        <p class='description'>".$fila['Descripcion']."</p>
                        <p class='author'>Autor: ".$fila2['Nombre']."</p>
                    </div>
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