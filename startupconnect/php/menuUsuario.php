<?php
session_start();
$nombre = $_SESSION["nombreUsuario"];
echo '
    <button id="menu-button" class="floating-button">☰</button>
        <aside class="menu" id="menu">
            <div id="header-menu">
            ';
            if(isset($_SESSION["imagenPerfil"])) {
                echo '<a href="perfilUsuario.php"><img id="imagenPerfil" src="'.$_SESSION["imagenPerfil"].'"></a>';
            } else {
                echo '<a href="perfilUsuario.php"><img id="imagenPerfil" src="../assets/img/perfilUsuario.png"></a>';
            }
            echo '
                <p>'.$nombre.'</p>
            </div>
            <ul>
                <li><a href="dashboard.php">'.$translations['navigation_menu_mis_proyectos'].'</a></li>
                <li><a href="formularioProyecto.php">'.$translations['navigation_menu_nuevo_proyecto'].'</a></li>
                <li><a href="contacto.php">'.$translations['navigation_menu_soporte'].'</a></li>
                <li><button class="logout-button" onclick="location.href=\'logout.php\'">'.$translations['navigation_menu_cerrar_sesion'].'</button></li>
            </ul>
            <img id="logo" src="../assets/img/LogoSConnect.png">
        </aside>
';

?>