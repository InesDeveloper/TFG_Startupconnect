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
            background: url("../assets/img/fondoproyectos1.png") !important;
        }
        
        h2 {
            text-align: center;
            color:black;
        }
        
        #gpt3-response {
            background: rgba(0, 0, 0, 0.5); 
            padding: 50px;
            margin: auto;
            margin-top: 50px;
            width: 80%; 
            max-width: 400px;
            border-radius: 10px;
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
            $('#gpt3-form').submit(function (e) {
                // Previene el comportamiento por defecto del formulario
                e.preventDefault();

                // Recupera el valor del campo de texto
                var prompt = $('#prompt').val();
                
                // Valida que el campo de texto no esté vacío
                if (!prompt) {
                    alert('Por favor, introduce una consulta válida.');
                    return;
                }

                // Muestra un mensaje de cargando mientras se procesa la solicitud
                $('#gpt3-response').html('<p>...</p>');

                // Hace una solicitud AJAX al servidor
                $.ajax({
                    type: 'POST',
                    url: 'controller.php',
                    data: { prompt: prompt },
                    success: function (response) {
                        // Muestra la respuesta del servidor en el elemento con ID gpt3-response
                        var simular = "Hola, ¿qué tal?"
                        $('#gpt3-response').html(simular);
                    },
                });
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
                        <h2>'.$translations['navigation_asistente'].'</h2>
                    ';

                echo '
                <div class="container-gpt-form">
                    <form id="gpt3-form">
                        <h3>'.$translations['formulario_asistente_titulo'].'</h3>
                        <textarea id="prompt" name="prompt" rows="3"></textarea>
                        <input type="submit" value="'.$translations['formulario_asistente_boton'].'">
                    </form>
                    <div id="gpt3-response" class="respuestaGPT"><h3>'.$translations['asistente_campo_respuesta'].'</h3></div>
                </div>';

                echo '
                    </main>
                ';
            }
            
        } else {
            include 'menuEmpresa.php';
            
            echo '
                <main class="content">
                    <h2>'.$translations['navigation_asistente'].'</h2>
                ';

            echo '
                <div class="container-gpt-form">
                    <form id="gpt3-form">
                        <h3>'.$translations['formulario_asistente_titulo'].'</h3>
                        <textarea id="prompt" name="prompt" rows="3"></textarea>
                        <input type="submit" value="'.$translations['formulario_asistente_boton'].'">
                    </form>
                    
                    <div id="gpt3-response" class="respuestaGPT"><h3>'.$translations['asistente_campo_respuesta'].'</h3></div>
                </div>';

            echo '
                </main>
            ';
        }
    ?>
</body>
</html>