<?php
$nombre = "unknown";
if(isset($_SESSION["nombreUsuario"])) {
    $nombre = $_SESSION["nombreUsuario"];
}
echo '
    <button id="menu-button" class="floating-button">☰</button>
        <aside class="menu" id="menu">
            <div id="header-menu">
                <img id="logo" src="../assets/img/LogoSConnect.png">
                <p>'.$nombre.'</p>
            </div>
            <ul>
                <li><a href="dashboard.php">'.$translations['navigation_menu_mis_proyectos'].'</a></li>
                <li><a href="formularioProyecto.php">'.$translations['navigation_menu_nuevo_proyecto'].'</a></li>
                <li><button class="logout-button" onclick="location.href=\'logout.php\'">'.$translations['navigation_menu_cerrar_sesion'].'</button></li>
            </ul>
        </aside>
';

?>