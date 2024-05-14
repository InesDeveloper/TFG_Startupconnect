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
        body {
            background: url("../assets/img/fondoproyectos1.png") !important;
        }
        
        .content {
            color: white;
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 50px;
            margin: auto;
            margin-top: 50px;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
        }
        
        input {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }

        input[type="submit"] {
            background: #64a19d; 
            color: var(--bs-white);
            border: none;
            cursor: pointer;
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
    } else if(isset($_GET["idColab"])){
        include 'menuEmpresa.php';
        $controlador = new ControladorBD();

        $consulta = "
        SELECT p.nombre AS nombre_proyecto, u.email as email_usuario, u.telefono as telefono_usuario
        FROM Colaboraciones c 
        JOIN Proyectos p 
        ON c.fk_Proyecto = p.Identificador 
        JOIN Usuarios u 
        ON p.fk_Usuarios = u.Identificador 
        WHERE c.Identificador = ".$_GET["idColab"];
        
        $resultado = $controlador->consulta($consulta);
        
        echo '<main class="content">';
                
        foreach ($resultado as $fila) {
            echo '<h2>'.$translations['contactar_proyecto_nombre'].'</h2><p>';
            echo $fila["nombre_proyecto"];
            echo '</p><h2>'.$translations['contactar_proyecto_telefono'].'</h2><p>';
            echo $fila["telefono_usuario"];
            echo '</p><h2>'.$translations['contactar_proyecto_email'].'</h2><p>';
            echo $fila["email_usuario"];
            echo '</p><br>';
        }

        echo ' 
            <form action="marcarContacto.php" method="POST">
                <input type="hidden" name="idColab" value="'.$_GET["idColab"].'">
                <input type="submit" value="'.$translations['contactar_proyecto_boton'].'">
            </form>
        ';
        
        echo '</main>';
        
    } else {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=dashboardEmpresas.php" /> ';
    }
?>
    
</body>
</html>