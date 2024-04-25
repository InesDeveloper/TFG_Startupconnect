<html>
    <head>
        <style>
            :root {
              --bs-teal: white;
              --bs-black: black;
              --bs-white: black;
              --bs-gray: rgba(0, 0, 0, 0.3);
              --bs-gray-dark: black;
              --bs-gray-100: black;
              --bs-primary: black;
              --bs-light: white;
              --bs-dark: black;
              --bs-black: black;
              --bs-white: white;
              --bs-primary-rgb: 100, 161, 157;
              --bs-black-rgb: 0, 0, 0;
            }
        /* Estilos del cuerpo y del formulario */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: var(--bs-black); /* Utiliza el color de fondo definido en el CSS */
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("pantallaprincipal/assets/img/imagen1.jpg");
             color: var(--bs-teal);
        }

        form {
            background: var(--bs-gray); /* Utiliza el color de fondo definido en el CSS */
            padding: 50px;
            margin: auto;
            margin-top: 100px;
            width: 90%; /* Ancho ajustado para que sea responsive */
            max-width: 400px; /* Ancho máximo para evitar que el formulario se extienda demasiado en pantallas grandes */
            border-radius: 10px;
        }

        /* Estilos para los inputs */
        input {
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }
            
        #inputFS {
            width: 100%;
        }

        /* Estilos para el botón */
        input[type="submit"] {
            background: var(--bs-primary); /* Utiliza el color de botón definido en el CSS */
            color: var(--bs-white); /* Utiliza el color de texto definido en el CSS */
            border: none;
            cursor: pointer;
        }

        /* Estilos para los enlaces */
        a {
            color: var(--bs-primary); /* Utiliza el color de enlace definido en el CSS */
        }

        /* Estilos para los mensajes de términos y condiciones */
        p {
            font-size: 0.8rem;
            color: var(--bs-teal); /* Utiliza el color de texto definido en el CSS */
        }

        /* Estilos para el título */
        h3 {
            color: var(white; /* Utiliza el color de texto definido en el CSS */
            margin-top: 0;
        }
    </style>
    </head>
    <body>
        <form action="../login/login.php" method="POST">
            <h3>Crear cuenta</h3>
            Nombre <br>
            <input id="inputFS" type="user" name="user"><br>
            Email<br>
            <input id="inputFS" type="text" name="email"><br>
            Contraseña<br>
            <input id="inputFS" type="password" name="password"><br>
            
            <label>
            <input type="checkbox" id="boxempresa" value="empresa" />
            Marca esta casilla si eres una empresa</label> <br>
   
            <p>Al hacer clic en «Aceptar y unirse» o «Continuar como», aceptas las Condiciones de uso, la Política de privacidad y la Política de cookies de StartupConnect 2024 ©</p>
            <input id="inputFS" type="submit" value="Aceptar y unirse">
        </form>
    </body>
</html>