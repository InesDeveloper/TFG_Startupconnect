<!DOCTYPE html> <!--Usuario -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById('menu-button').addEventListener('click', function() {
                const menu = document.getElementById('menu');
                menu.classList.toggle('show-menu');
            });
        });
    </script>
</head>
<body>
    <?php
        include '../conexionBD/conexiondb.php';
        session_start();

        if (!isset($_SESSION['language'])) {
            $_SESSION['language'] = 'es';
        }
    
        require_once('../lenguajes/' . $_SESSION['language'] . '.php');
    
        if(!isset($_SESSION["idUsuario"]) && // Si existe sesion de usuario para aportar seguridad
           !isset($_SESSION["nombreUsuario"])) {
            echo $translations['dashboard_empresa_sin_login'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
        } else {
            include 'menuUsuario.php';
            echo '
                <main class="content">
                    <h2>'.$translations['formulario_proyecto_titulo'].'</h2>
                    
                    <form method="POST" action="insertarProyecto.php">
                        <label for="nombre">Nombre:</label><br>
                        <input type="text" id="nombre" name="nombre" maxlength="255" required><br>

                        <label for="descripcion">Descripción:</label><br>
                        <input type="text" id="descripcion" name="descripcion" maxlength="300" required><br>

                        <label for="urlVideo">URL del Video:</label><br>
                        <input type="text" id="urlVideo" name="urlVideo" maxlength="255"><br>

                        <label for="sector">Sector:</label><br>
                        <select name="fk_sector" id="sector" required>
                            <option value="" disabled selected>'.$translations['dashboard_sectores_valor_defecto'].'</option>';
                            
                            $controlador = new ControladorBD();
                            $consulta_sectores = "SELECT * FROM Sector";
                            $resultado_sectores = $controlador->consulta($consulta_sectores);

                            foreach ($resultado_sectores as $sector) {
                                $tipo = $sector['Tipo'];
                                echo '<option value="'.$sector['Identificador'].'"';
                                if(isset($_GET['sector']) && $_GET['sector'] == $sector['Tipo']) {
                                    echo ' selected';
                                }
                                echo '>'.$translations[$tipo].'</option>';
                            }

                        echo '
                        </select><br>
                        <input type="submit" value="Enviar">
                    </form>
                </main>
            ';
            include 'bandejadeEntrada.php';
        }
    ?>
</body>
</html>
