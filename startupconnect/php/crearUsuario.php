<html> <!-- Formularios de registro de usuario y empresa -->
    <head>
        <link href="../css/crearUsuario.css" rel="stylesheet" />
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const typeSelect = document.getElementById('typeSelect');
                const usuarioForm = document.getElementById('usuarioForm');
                const empresaForm = document.getElementById('empresaForm');

                typeSelect.addEventListener('change', () => {
                    const selectedType = typeSelect.value;

                    usuarioForm.style.display = 'none';
                    empresaForm.style.display = 'none';

                    if (selectedType === 'usuario') {
                        usuarioForm.style.display = 'block';
                    } else if (selectedType === 'empresa') {
                        empresaForm.style.display = 'block';
                    }
                });
            });
        </script>
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
        <div>
            <label for="typeSelect"><?php echo $translations['crear_cuenta_seccionar_tipo']; ?></label>
            <select id="typeSelect" name="typeSelect">
                <option value=""><?php echo $translations['crear_cuenta_secciona'];?></option>
                <option value="usuario"><?php echo $translations['crear_cuenta_secciona_usuario']; ?></option>
                <option value="empresa"><?php echo $translations['crear_cuenta_secciona_empresa']; ?></option>
            </select>
        </div>
        
        <form id="usuarioForm" action="registrarUsuario.php" method="POST" style="display: none;">
            <h3><?php echo $translations['index_crear_cuenta']; ?></h3>
            <?php echo $translations['crear_cuenta_nombre']; ?> <br>
            <input type="user" name="user" required><br>
            <?php echo $translations['crear_cuenta_apellidos']; ?> <br>
            <input type="user" name="apellidos" required><br>
            <?php echo $translations['crear_cuenta_dni']; ?><br>
            <input type="text" name="dni" required><br>
            <?php echo $translations['crear_cuenta_email']; ?><br>
            <input type="text" name="email" required><br>
            <?php echo $translations['crear_cuenta_contrasena']; ?><br>
            <input type="password" name="password" required><br>
            <?php echo $translations['crear_cuenta_direccion']; ?><br>
            <input type="text" name="direccion" required><br>
            <?php echo $translations['crear_cuenta_telefono']; ?><br>
            <input type="tel" name="telefono" required><br>
   
            <p><?php echo $translations['crear_cuenta_privacidad']; ?></p>
            <input type="submit" value="Aceptar y unirse">
        </form>
        
        <form id="empresaForm" action="registrarEmpresa.php" method="POST" style="display: none;">
            <h3><?php echo $translations['index_crear_cuenta_empresa']; ?></h3>
            <?php echo $translations['crear_cuenta_nombre']; ?> <br>
            <input type="user" name="user" required><br>
            <?php echo $translations['crear_cuenta_cif']; ?><br>
            <input type="text" name="cif" required><br>
            <?php echo $translations['crear_cuenta_email']; ?><br>
            <input type="email" name="email" required><br>
            <?php echo $translations['crear_cuenta_contrasena']; ?><br>
            <input type="password" name="password" required><br>
            <?php echo $translations['crear_cuenta_direccion']; ?><br>
            <input type="text" name="direccion" required><br>
            <?php echo $translations['crear_cuenta_telefono']; ?><br>
            <input type="tel" name="telefono" required><br>
   
            <p><?php echo $translations['crear_cuenta_privacidad']; ?></p>
            <input type="submit" value="Aceptar y unirse">
        </form>
    </body>
</html>