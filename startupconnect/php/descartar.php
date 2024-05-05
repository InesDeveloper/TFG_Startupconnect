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
    
       if (isset($_POST['idProyecto']) && 
            isset($_POST['idEmpresa']) &&
            isset($_POST['motivo'])) {
            $controlador = new ControladorBD();
            $consulta = "INSERT INTO Descartes (fk_Proyecto, fk_Empresa, motivo) VALUES ('".$_POST['idProyecto']."', '".$_POST['idEmpresa']."', '".$_POST['motivo']."');";

            $resultado = $controlador->consulta($consulta);

            if($resultado) {
                    echo $translations['descarte_exito'];
                    echo '<meta http-equiv="Refresh" content="2; url=dashboardEmpresas.php" /> ';
            } else {
                    echo $translations['descarte_fallo'];
                    echo '<meta http-equiv="Refresh" content="2; url=detallesProyecto.php" /> ';
            }

        } else {
            echo $translations['descarte_motivo_vacio'];
            echo '<meta http-equiv="Refresh" content="2; url=datallesProyecto.php" /> ';
        }
    }
?>