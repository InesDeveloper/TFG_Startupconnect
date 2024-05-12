<!DOCTYPE html>
<html lang="<?php echo $_SESSION['language']; ?>">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <style>
        body {
            height: 250vh;
        }
        
        h2 {
            text-align: center;
        }
        
        form {
            background: var(--bs-gray); /* Utiliza el color de fondo definido en el CSS */
            padding: 50px;
            margin: auto;
            margin-top: 50px;
            width: 80%; /* Ancho ajustado para que sea responsive */
            max-width: 400px; /* Ancho máximo para evitar que el formulario se extienda demasiado en pantallas grandes */
            border-radius: 10px;
        }

        /* Estilos para los inputs */
        input {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }

        /* Estilos para el botón */
        input[type="submit"] {
            background: #64a19d; 
            color: var(--bs-white);
            border: none;
            cursor: pointer;
        }
    </style>
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
    
        if(!isset($_SESSION["idEmpresa"]) && // Si existe sesion de empresa para aportar seguridad
           !isset($_SESSION["nombreEmpresa"])) {
            echo $translations['dashboard_empresa_sin_login'];
            echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
        } else {
            include 'menuEmpresa.php';
            echo '<main class="content">
                    <h2>'.$translations['perfil_titulo'].'</h2>';
            
            $controlador = new ControladorBD();
            $consulta = "SELECT * FROM Empresas WHERE Identificador = ".$_SESSION["idEmpresa"].";";
            $resultado = $controlador->consulta($consulta);
    
            echo "
                <form action='actualizarEmpresa.php' method='POST'>";
                foreach ($resultado as $fila) {
                    echo $translations['crear_cuenta_nombre']; echo "<br>";
                    echo '<input type="user" name="user" value="'.$fila["Nombre"].'" required><br><br>';
                    echo $translations['crear_cuenta_cif']; echo "<br>";
                    echo '<input type="text" name="cif" value="'.$fila["CIF"].'" required><br><br>';
                    echo $translations['crear_cuenta_direccion']; echo "<br>";
                    echo '<input type="text" name="direccion" value="'.$fila["Direccion"].'" required><br><br>';
                    echo $translations['crear_cuenta_telefono']; echo "<br>";
                    echo '<input type="tel" name="telefono" value="'.$fila["Telefono"].'" required><br><br>';
                }
            
            echo "<input type='submit' value='".$translations['perfil_boton_actualizar_datos']."'>
                </form>";
            
            echo '
            <form action="subirImagenEmpresa.php" method="post" enctype="multipart/form-data">
                <label for="fileToUpload">'.$translations['perfil_selecciona_imagen'].'</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="'.$translations['perfil_boton_imagen'].'" name="submit">
            </form>
            ';
            
            echo '
            <form action="cambiarContrasena.php" method="post">
                '.$translations['perfil_nueva_contrasena'].'<br>
                <input type="password" name="password" required><br>
                '.$translations['perfil_repetir_contrasena'].'<br>
                <input type="password" name="repitepassword" required><br>
                <input type="submit" value="'.$translations['perfil_boton_contrasena'].'">
            </form>
            ';
            
            echo '
            <form action="eliminarCuenta.php" method="post">
                <input type="submit" value="'.$translations['perfil_boton_borrar_cuenta'].'" name="botonBorrar" class="botonBorrar">
            </form>
            ';
     
            echo '</main>';
            include 'bandejadeEntrada.php';
        }
    ?>
</body>
</html>
