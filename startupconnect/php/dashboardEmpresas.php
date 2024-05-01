<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página con Tres Secciones</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById('menu-button').addEventListener('click', function() {
                const menu = document.getElementById('menu');
                console.log("Pulsado");
                menu.classList.toggle('show-menu');
            });
        });
    </script>
</head>
<body>
    <button id="menu-button" class="floating-button">☰</button>
    <aside class="menu" id="menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Configuraciones</a></li>
            <li><a href="#">Ayuda</a></li>
        </ul>
    </aside>
    <main class="content">
        <h2>Listado de proyectos</h2>
        <div class="articles">
            <div class="article">
                <h2 class="title">Título del Artículo</h2>
                <p class="description">Descripción del artículo. Aquí puedes colocar un resumen breve del contenido para dar una idea de lo que trata.</p>
                <p class="author">Autor: Nombre del Autor</p>
            </div>
            <div class="article">
                <h2 class="title">Título del Artículo 2</h2>
                <p class="description">Descripción del artículo. Aquí puedes colocar un resumen breve del contenido para dar una idea de lo que trata.</p>
                <p class="author">Autor: Nombre del Autor 2</p>
            </div>
        </div>
    </main>
    <aside class="news">
        <h2>Noticias</h2>
        <p>Aquí se mostrarán las últimas noticias.</p>
    </aside>
</body>
</html>