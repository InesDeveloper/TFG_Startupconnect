<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff !important;
            height: 100vh !important;
            background-repeat: no-repeat;
        }
        
        .content {
            color: white;
            width: 100% !important;
            background: url("../assets/img/fondoproyectos1.png") !important;
        }
        
        h2 {
            text-align: center;
            color:black;
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
    
        if(!isset($_SESSION["idEmpresa"]) && // Si existe sesion de empresa para aportar seguridad
           !isset($_SESSION["nombreEmpresa"])) {
            
                echo $translations['dashboard_empresa_sin_login'];
                echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';   
            
        } else {
            include 'menuEmpresa.php';
            
            echo '
                <main class="content">
                    <h2>'.$translations['seccion_noticias_titulo'].'</h2>
                    <div class="articles">
                ';
            
            $controlador = new ControladorBD();
            $consultaColaboraciones = "
            SELECT p.nombre, c.Identificador 
            FROM Colaboraciones c JOIN Proyectos p 
            ON c.fk_Proyecto = p.Identificador 
            WHERE c.fk_Empresa = ".$_SESSION["idEmpresa"]." AND c.contactado = 0
            ORDER BY c.fechaRegistro DESC LIMIT 5";

            $resultadoColaboraciones = $controlador->consulta($consultaColaboraciones);

            if (count($resultadoColaboraciones) > 0) {
                foreach ($resultadoColaboraciones as $colaboracion) {
                    echo '<div class="colaboracion">'.$translations['bandeja_entrada_aceptado']. htmlspecialchars($colaboracion['nombre']) .'. 
                    <a href="contactarProyecto.php?idColab='.$colaboracion["Identificador"].'" class="bell-icon">'.$translations['bandeja_entrada_contacta'].'</a></div>';
                }
            } else {
                echo '<h4>'.$translations['bandeja_entrada_proyectos_vacios'].'</h4>';
            }
            
            echo '  </div>
                </main>
            ';
        }
    ?>
</body>
</html>
