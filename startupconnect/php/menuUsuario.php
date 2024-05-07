<?php
echo '
    <button id="menu-button" class="floating-button">☰</button>
        <aside class="menu" id="menu">
            <ul>
                <li><a href="dashboard.php">'.$translations['navigation_menu_mis_proyectos'].'</a></li>
                <li><a href="nuevoProyecto.php">'.$translations['navigation_menu_nuevo_proyecto'].'</a></li>
                <li><button class="logout-button" onclick="location.href=\'logout.php\'">'.$translations['navigation_menu_cerrar_sesion'].'</button></li>
            </ul>
        </aside>
';

?>