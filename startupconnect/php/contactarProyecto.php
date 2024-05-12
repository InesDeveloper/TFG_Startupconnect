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
            height: 120vh;
        }
        
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
        min-width: 45%; /* Ajusta el ancho mínimo de los formularios */
    }

    /* Estilos para pantallas pequeñas */
    @media (max-width: 768px) {
        .form-container {
            flex-direction: column; /* Cambia a disposición vertical */
        }

        .form-container form {
            min-width: 100%; /* Formularios ocupan todo el ancho */
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
            echo '<h2>Nombre del proyecto</h2><p>';
            echo $fila["nombre_proyecto"];
            echo '</p><h2>Teléfono de contacto</h2><p>';
            echo $fila["telefono_usuario"];
            echo '</p><h2>Email:</h2><p>';
            echo $fila["email_usuario"];
            echo '</p><br>';
        }

        echo ' 
            <form action="marcarContacto.php" method="POST">
                <input type="hidden" name="idColab" value="'.$_GET["idColab"].'">
                <input type="submit" value="Marcar como contactado">
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