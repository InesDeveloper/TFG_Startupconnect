<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff !important;
            height: 100vh !important;
            background-repeat: no-repeat;
        }
        
        .menu {
            width: 300px !important;
        }
        
        .content {
            color: white;
            background: url("../assets/img/fondo.png") !important;
        }
        
        h2 {
            text-align: center;
            color:black;
        }
        
        form {
            background: rgba(0, 0, 0, 0.5); 
            padding: 50px;
            margin: auto;
            margin-top: 50px;
            width: 80%; 
            max-width: 400px;
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
        
        textarea{
            height: 100px;
            width: 100%;
            resize: none;
        }

        /* Estilos para el botón */
        input[type="submit"] {
            width: 100%;
            background: #64a19d; 
            color: var(--bs-white);
            border: none;
            cursor: pointer;
        }
    </style>
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
            
            if(!isset($_SESSION["idUsuario"]) && // Si existe sesion de usuario para aportar seguridad
            !isset($_SESSION["nombreUsuario"])) {
                
                echo $translations['dashboard_empresa_sin_login'];
                echo '<meta http-equiv="Refresh" content="2; url=../index.php" /> ';
            
            } else {
                include 'menuUsuario.php';
            
                echo '
                    <main class="content">
                        <h2>'.$translations['contacto_titulo'].'</h2>
                    ';

                echo '<form id="usuarioForm" action="emailcontroller.php" method="POST">
                        '.$translations['crear_cuenta_nombre'].'<br>
                        <input type="user" name="nombre" required><br>
                        '.$translations['crear_cuenta_apellidos'].'<br>
                        <input type="user" name="apellidos" required><br>
                        '.$translations['crear_cuenta_email'].'<br>
                        <input type="text" name="email" required><br>
                        '.$translations['crear_cuenta_telefono'].'<br>
                        <input type="tel" name="telefono" required><br>
                        '.$translations['contacto_mensaje'].'<br>
                        <input type="text" name="mensaje" required><br>

                        <input type="submit" value="'.$translations['formulario_enviar'].'">
                    </form>';

                echo '
                    </main>
                ';
            }
            
        } else {
            include 'menuEmpresa.php';
            
            echo '
                <main class="content">
                    <h2>'.$translations['contacto_titulo'].'</h2>
                ';

            echo '<form id="usuarioForm" action="emailcontroller.php" method="POST">
                    '.$translations['crear_cuenta_nombre'].'<br>
                    <input type="user" name="nombre" required><br>
                    '.$translations['crear_cuenta_apellidos'].'<br>
                    <input type="user" name="apellidos" required><br>
                    '.$translations['crear_cuenta_email'].'<br>
                    <input type="text" name="email" required><br>
                    '.$translations['crear_cuenta_telefono'].'<br>
                    <input type="tel" name="telefono" required><br>
                    '.$translations['contacto_mensaje'].'<br>
                    <textarea id="mensaje" name="mensaje" required></textarea><br>

                    <input type="submit" value="'.$translations['formulario_enviar'].'">
                </form>';

            echo '
                </main>
            ';
        }
    
    ?>
</body>
</html>