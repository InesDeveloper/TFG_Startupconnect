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
            echo "Logeate primero";
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
        } else {
            echo '
                <button id="menu-button" class="floating-button">☰</button>
                <aside class="menu" id="menu">
                    <ul>
                        <li><a href="dashboardEmpresas.php">Inicio</a></li>
                        <li><a href="colaboraciones.php">Colaboraciones</a></li>
                        <li><a href="descartados.php">Descartados</a></li>
                        <li><a href="logout.php">Cerrar sesión</a></li>
                    </ul>
                </aside>
                <main class="content">
                    <h2>Listado de descartados</h2>
                    <div class="articles">
                ';
            $controlador = new ControladorBD();
            $consulta = "SELECT * FROM Descartes WHERE fk_Empresa = '".$_SESSION["idEmpresa"]."';";

            $resultado = $controlador->consulta($consulta);
    
            foreach ($resultado as $fila) {
                $consulta2 = "
                SELECT 
                    p.Nombre AS ProyectoNombre, 
                    p.Descripcion AS ProyectoDescripcion,
                    u.Nombre AS UsuarioNombre
                FROM 
                    Proyectos p
                INNER JOIN 
                    Usuarios u 
                ON 
                    p.fk_Usuarios = u.Identificador
                WHERE 
                    p.Identificador = '".$fila["fk_Proyecto"]."';";

                $resultado2 = $controlador->consulta($consulta2);
                foreach ($resultado2 as $fila2) {
                    echo "
                    <div class='article'>
                        <h2 class='title'>".$fila2['ProyectoNombre']."</h2>
                        <p class='description'>".$fila2['ProyectoDescripcion']."</p>
                        <p class='author'>Autor: ".$fila2['UsuarioNombre']."</p>
                    </div>
                ";
                }
            }
   
            echo '
                    </div>
                </main>
                <aside class="news">
                    <h2>Noticias</h2>
                    <p>Aquí se mostrarán las últimas noticias.</p>
                </aside>
            ';
        }
    ?>
</body>
</html>