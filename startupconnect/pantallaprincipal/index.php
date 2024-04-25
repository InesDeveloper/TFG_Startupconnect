<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="css/styles.css" rel="stylesheet" />
        <script>
            function changeLanguage(lang) {
                var newLanguage = lang == 'es' ? 'en' : "es";
                
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '?lang=' + newLanguage, true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Recargar la página para reflejar el cambio de idioma
                        location.reload();
                    }
                };
                xhr.send();
            }
        </script>
    </head>
    <body id="page-top">
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
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container 4px 5px-lg-rigth">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <?php echo $translations['index_crear_cuenta']; ?>
                    <i class="fas fa-bars"></i>
                </button>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" onclick="changeLanguage('<?php echo $_SESSION['language']; ?>')">
                    ES / EN
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"> <a class="nav-link" href="#registro"><?php echo $translations['index_crear_cuenta']; ?></a></li>
                        <li class="nav-item"> <a class="nav-link" href="#lenguaje">ES / EN</a></li>
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
                        <a class="btn btn-primary" href="#about"><?php echo $translations['index_iniciar_sesion']; ?></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; StartupConnect 2024</div></footer>
    </body>
</html>
