<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            width: 50%;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        input, textarea {
            display: block;
            width: 100%;
            height: 25px;
            margin-bottom: 10px;
        }
        input, textarea {
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea{
            height: 100px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            height: 40px;
        }
        input[type="submit"]:hover {
            background-color: #44d94b;
        }
        @media (max-width: 768px) {
            .container {
                width: 100%;
                margin: auto;
            }
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

                        <input type="submit" value="Enviar">
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

                    <input type="submit" value="Enviar">
                </form>';

            echo '
                </main>
            ';
        }
    
    ?>
</body>
</html>