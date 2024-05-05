<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
    /* Estilos para los formularios */
    .form-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
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
    <script>
        
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
    } else if(isset($_GET["idProyecto"])){
        $controlador = new ControladorBD();
        $consulta = "
                SELECT *
                FROM proyectos
                WHERE Identificador = ".$_GET["idProyecto"]."
                ";
        $resultado = $controlador->consulta($consulta);
        
        foreach ($resultado as $fila) {
            echo '<h2>'.$translations['detalles_proyecto_nombre'].'</h2><p>';
            echo $fila["Nombre"];
            echo '</p><h2>'.$translations['detalles_proyecto_descripcion'].'</h2><p>';
            echo $fila["Descripcion"];
            echo '</p><hr>
            <p>'.$translations['detalles_proyecto_accion'].'</p>';
        }

        echo ' 
        <div class="form-container">
            <form action="colaborar.php" method="POST">
                <h3>'.$translations['detalle_proyecto_formulario_colaborar'].'</h3>
                <input type="hidden" name="idProyecto" value="'.$_GET["idProyecto"].'">
                <input type="hidden" name="idEmpresa" value="'.$_SESSION["idEmpresa"].'">
                <input type="submit" value="'.$translations['detalles_proyecto_boton_colaborar'].'">
            </form>

            <form action="descartar.php" method="POST">
                <h3>'.$translations['detalle_proyecto_formulario_descartar'].'</h3>
                <p>'.$translations['detalles_proyecto_motivo'].'</p>
                <input type="hidden" name="idProyecto" value="'.$_GET["idProyecto"].'">
                <input type="hidden" name="idEmpresa" value="'.$_SESSION["idEmpresa"].'">
                <input type="text" name="motivo" required>
                <input type="submit" value="'.$translations['detalles_proyecto_boton_descartar'].'">
            </form>
        </div>
        ';
        
    } else {
        echo $translations['dashboard_empresa_sin_login'];
        echo '<meta http-equiv="Refresh" content="2; url=dashboardEmpresas.php" /> ';
    }
?>
    
</body>
</html>