<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/scripts.js"></script>
    </head>
    <body id="page-top">
        <?php
            session_start();
            
            if (!isset($_SESSION['language'])) {
                $_SESSION['language'] = 'es';
            }
        
            if(isset($_GET['lang'])) {
                if ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') {
                    $_SESSION['language'] = $_GET['lang'];
                } 
            }
        
            require_once('lenguajes/' . $_SESSION['language'] . '.php');
        ?>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container 4px 5px-lg-rigth">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" onclick="window.location.href='php/crearUsuario.php'">
                    <?php echo $translations['index_crear_cuenta']; ?>
                </button>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" onclick="changeLanguage('<?php echo $_SESSION['language']; ?>')">
                    ES / EN
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"> <a class="nav-link" href="php/crearUsuario.php"><?php echo $translations['index_crear_cuenta']; ?></a></li>
                        <li class="nav-item"> <a class="nav-link" href="" onclick="changeLanguage('<?php echo $_SESSION['language']; ?>')">ES / EN</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead">
            <div class="container 4px 5px d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto text-uppercase">STARTUPCONNECT</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5"><?php echo $translations['index_description']; ?></h2>
                        
                        <form method="post" action="php/login.php">
                            <label><?php echo $translations['index_email']; ?></label><br>
                            <input type="text" name="email"><br>
                            <label><?php echo $translations['index_contrasena']; ?></label><br>
                            <input type="password" name="password"><br><br>
                            <label>
                            <input type="checkbox" name="boxempresa" value="empresa" />
                            <?php echo $translations['index_empresa']; ?></label> <br>
                            <input class="btn btn-primary" type="submit" value="<?php echo $translations['index_iniciar_sesion']; ?>">
                        </form>
                        
                    </div>
                </div>
            </div>
            
        </header>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50">
            <div class="container px-4 px-lg-5">Copyright &copy; StartupConnect 2024</div></footer>
    </body>
</html>
