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
    
       if (isset($_POST['idColab'])) {
            $controlador = new ControladorBD();
            $consulta = "UPDATE Colaboraciones SET contactado ='1' WHERE Identificador = ".$_POST['idColab'].";";

            $resultado = $controlador->consulta($consulta);

            if($resultado) {
                    echo $translations['marcar_contactado_exito'];
                    echo '<meta http-equiv="Refresh" content="2; url=dashboardEmpresas.php" /> ';
            } else {
                    echo $translations['marcar_contactado_fallo'];
                    echo '<meta http-equiv="Refresh" content="2; url=detallesProyecto.php" /> ';
            }

        } else {
            echo '<meta http-equiv="Refresh" content="2; url=datallesProyecto.php" /> ';
        }
    }
?>
