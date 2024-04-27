<html>
    <head>
        <link href="../css/crearUsuario.css" rel="stylesheet" />
    </head>
    <body>
        <?php
            session_start();
            
            if (!isset($_SESSION['language'])) {
                $_SESSION['language'] = 'es';
            }
        
            if ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') {
                $_SESSION['language'] = $_GET['lang'];
            }
        
            require_once('../lenguajes/' . $_SESSION['language'] . '.php');
        ?>
        <form action="../registrar.php" method="POST">
            <h3><?php echo $translations['index_crear_cuenta']; ?></h3>
            <?php echo $translations['crear_cuenta_nombre']; ?> <br>
            <input id="inputFS" type="user" name="user"><br>
            <?php echo $translations['crear_cuenta_email']; ?><br>
            <input id="inputFS" type="text" name="email"><br>
            <?php echo $translations['crear_cuenta_contrasena']; ?><br>
            <input id="inputFS" type="password" name="password"><br>
            
            <label>
            <input type="checkbox" id="boxempresa" value="empresa" />
            <?php echo $translations['crear_cuenta_empresa']; ?></label> <br>
   
            <p><?php echo $translations['crear_cuenta_privacidad']; ?></p>
            <input id="inputFS" type="submit" value="Aceptar y unirse">
        </form>
    </body>
</html>