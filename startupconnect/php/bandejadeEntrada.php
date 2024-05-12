<?php

$controlador = new ControladorBD();

if(isset($_SESSION["idUsuario"]) &&
   isset($_SESSION["nombreUsuario"])) {
    echo '
        <aside class="news">
            <h2>'.$translations['seccion_noticias_titulo'].'</h2>
            <p>'.$translations['proximamente'].'</p>
        </aside>
    ';
    
} else if(isset($_SESSION["idEmpresa"]) &&
   isset($_SESSION["nombreEmpresa"])) {
    
    echo '
        <aside class="news">
            <h2>'.$translations['seccion_noticias_titulo'].'</h2>
            <div class="colaboraciones">';
    
    $consultaColaboraciones = "
    SELECT p.nombre, c.Identificador 
    FROM Colaboraciones c JOIN Proyectos p 
    ON c.fk_Proyecto = p.Identificador 
    WHERE c.fk_Empresa = ".$_SESSION["idEmpresa"]." AND c.contactado = 0
    ORDER BY c.fechaRegistro DESC LIMIT 5";
    
    $resultadoColaboraciones = $controlador->consulta($consultaColaboraciones);
    
    if (count($resultadoColaboraciones) > 0) {
        foreach ($resultadoColaboraciones as $colaboracion) {
            echo '<div class="colaboracion">Has aceptado colaborar con el proyecto ' . htmlspecialchars($colaboracion['nombre']) .'. 
            <a href="contactarProyecto.php?idColab='.$colaboracion["Identificador"].'">Pulsa aqui para ponerte en contacto.</a></div>';
        }
    } else {
        echo '<h4>No hay proyectos recientes.</h4>';
    }
    
    echo '</div>
    </aside>';
    
} else {
    echo $translations['dashboard_empresa_sin_login'];
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
    
}

?>