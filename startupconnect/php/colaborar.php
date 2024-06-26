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
        isset($_POST['idEmpresa'])) {
            $controlador = new ControladorBD();
            $fechaActual = date('Y-m-d H:i:s');

            $consulta = "INSERT INTO Colaboraciones (fk_Proyecto, fk_Empresa, fechaRegistro, contactado) 
            VALUES ('".$_POST['idProyecto']."', '".$_POST['idEmpresa']."', '".$fechaActual."', '0');";

            $resultado = $controlador->consulta($consulta);
            echo $consulta;


            if($resultado) {
                    echo $translations['colaboracion_exito'];
                    echo '<meta http-equiv="Refresh" content="2; url=dashboardEmpresas.php" /> ';
            } else {
                    echo $translations['colaboracion_fallo'];
                    echo '<meta http-equiv="Refresh" content="2; url=detallesProyecto.php?idProyecto='.$_POST['idProyecto'].'" /> ';
            }

        } else {
            echo '<meta http-equiv="Refresh" content="2; url=datallesProyecto.php?idProyecto='.$_POST['idProyecto'].'" /> ';
        }
    }
?>