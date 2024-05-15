<?php

$controlador = new ControladorBD();

if(isset($_SESSION["idUsuario"]) &&
   isset($_SESSION["nombreUsuario"])) {
    echo '
        <aside class="news">
            <h2>'.$translations['seccion_noticias_titulo'].'</h2>
            <div class="colaboraciones">';
    
        $consultaColaboraciones = "
        SELECT
            p.Nombre AS NombreProyecto,
            e.Nombre AS NombreEmpresa
        FROM
            Colaboraciones c
        JOIN
            Proyectos p ON c.fk_Proyecto = p.Identificador
        JOIN
            Empresas e ON c.fk_Empresa = e.Identificador
        WHERE
            p.fk_Usuarios = ".$_SESSION["idUsuario"]." AND c.contactado = 0
        ORDER BY
            c.fechaRegistro DESC
        LIMIT 5;";
    
        $resultadoColaboraciones = $controlador->consulta($consultaColaboraciones);
    
        $consultaDescartados = "
            SELECT
                p.Nombre AS NombreProyecto,
                e.Nombre AS NombreEmpresa,
                d.Motivo AS motivo
            FROM
                Descartes d
            JOIN
                Proyectos p ON d.fk_Proyecto = p.Identificador
            JOIN
                Empresas e ON d.fk_Empresa = e.Identificador
            WHERE
                p.fk_Usuarios = ".$_SESSION["idUsuario"]." 
            ORDER BY
                d.fechaRegistro DESC
            LIMIT 5;";
    
        $resultadoDescartes = $controlador->consulta($consultaDescartados);
    
        if(is_array($resultadoColaboraciones) && count($resultadoColaboraciones) > 0) {
            foreach ($resultadoColaboraciones as $colaboracion) {
                echo '<div class="colaboracion">'.sprintf($translations['bandeja_entrada_usuario_colab'], $colaboracion['NombreEmpresa'], $colaboracion['NombreProyecto']).'</div>';
            }
        }
    
        if (is_array($resultadoDescartes) && count($resultadoDescartes) > 0) {
            echo '<hr>';
            foreach ($resultadoDescartes as $descarte) {
                echo '<div class="colaboracion">'.sprintf($translations['bandeja_entrada_usuario_descarte'], $descarte['NombreEmpresa'], $descarte['NombreProyecto'], $descarte['motivo']).'</div>';
            }
        }
        
        if ((is_array($resultadoDescartes) && count($resultadoDescartes) == 0) && (is_array($resultadoColaboraciones) && count($resultadoColaboraciones) == 0)) {
            echo '<h4>'.$translations['bandeja_entrada_proyectos_vacios'].'</h4>';
        }
            
    echo '  </div>
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
            echo '<div class="colaboracion">'.$translations['bandeja_entrada_aceptado']. htmlspecialchars($colaboracion['nombre']) .'. 
            <a href="contactarProyecto.php?idColab='.$colaboracion["Identificador"].'">'.$translations['bandeja_entrada_contacta'].'</a></div>';
        }
    } else {
        echo '<h4>'.$translations['bandeja_entrada_proyectos_vacios'].'</h4>';
    }
    
    echo '</div>
    </aside>';
    
} else {
    echo $translations['dashboard_empresa_sin_login'];
    echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';   
}

?>