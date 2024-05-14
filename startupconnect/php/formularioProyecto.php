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
    <style>
        h2 {
            text-align: center;
            color:black;
        }
        
        form {
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 50px;
            margin: auto;
            margin-top: 50px;
            width: 80%; 
            max-width: 400px; 
            border-radius: 10px;
        }

        input {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }

        
        input[type="submit"] {
            background: #64a19d; 
            color: var(--bs-white);
            border: none;
            cursor: pointer;
        }
    </style>
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
                        <label for="nombre">'.$translations['crear_proyecto_nombre'].'</label><br>
                        <input type="text" id="nombre" name="nombre" maxlength="255" required><br>

                        <label for="descripcion">'.$translations['crear_proyecto_descripcion'].'</label><br>
                        <input type="text" id="descripcion" name="descripcion" maxlength="300" required><br>

                        <label for="urlVideo">'.$translations['crear_proyecto_url_video'].'</label><br>
                        <input type="text" id="urlVideo" name="urlVideo" maxlength="255"><br>

                        <label for="sector">'.$translations['crear_proyecto_sector'].'</label><br>
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
                        <input type="submit" value="'.$translations['crear_proyecto_boton'].'">
                    </form>
                </main>
            ';
            //include 'bandejadeEntrada.php';
        }
    ?>
</body>
</html>
