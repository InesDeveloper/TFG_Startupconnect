<?php
$nombre = "unknown";
if(isset($_SESSION["nombreEmpresa"])) {
    $nombre = $_SESSION["nombreEmpresa"];
}
echo '
    <button id="menu-button" class="floating-button">☰</button>
        <aside class="menu" id="menu">
            <div id="header-menu">
            ';

            if(isset($_SESSION["imagenPerfil"])) {
                echo '<a href="perfilEmpresa.php"><img id="imagenPerfil" src="'.$_SESSION["imagenPerfil"].'"></a>';
            } else {
                echo '<a href="perfilEmpresa.php"><img id="imagenPerfil" src="../assets/img/perfilUsuario.png"></a>';
            }

            echo '
                <p>'.$nombre.'</p>
            </div>
            <ul>
                <li><button class="navButton" onclick="location.href=\'dashboardEmpresas.php\'">'.$translations['navigation_menu_proyectos'].'</button></li>
                <li><button class="navButton" onclick="location.href=\'colaboraciones.php\'">'.$translations['navigation_menu_colaboraciones'].'</button></li>
                <li><button class="navButton" onclick="location.href=\'descartados.php\'">'.$translations['navigation_menu_descartados'].'</button></li>
                <li><button class="navButton" onclick="location.href=\'contacto.php\'">'.$translations['navigation_menu_soporte'].'</button></li>
                <li><button class="navButton" onclick="location.href=\'asistenteVirtual.php\'">'.$translations['navigation_asistente'].'</button></li>
                <li id="botonNotificaciones"><button class="navButton" onclick="location.href=\'notificaciones.php\'">'.$translations['seccion_noticias_titulo'].'</button></li>
                <li><button class="logout-button" onclick="location.href=\'logout.php\'">'.$translations['navigation_menu_cerrar_sesion'].'</button></li>
            </ul>
            <img id="logo" src="../assets/img/LogoSConnect.png">
        </aside>
';

?>