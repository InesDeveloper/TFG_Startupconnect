<?php
echo '
    <button id="menu-button" class="floating-button">☰</button>
        <aside class="menu" id="menu">
            <ul>
                <li><a href="dashboardEmpresas.php">'.$translations['navigation_menu_proyectos'].'</a></li>
                <li><a href="colaboraciones.php">'.$translations['navigation_menu_colaboraciones'].'</a></li>
                <li><a href="descartados.php">'.$translations['navigation_menu_descartados'].'</a></li>
                <li><button class="logout-button">'.$translations['navigation_menu_cerrar_sesion'].'</button></li>
            </ul>
        </aside>
';

?>