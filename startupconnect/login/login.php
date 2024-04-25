<?php

session_start();
$mysqli = new mysqli("localhost","startupconnect","startupconnect","startupconnect");
    
$consulta = "SELECT * FROM usuarios WHERE user = '".$_POST['user']."'AND password = '".$_POST['password']."'";
    
$resultado = $mysqli->query($consulta);

$pasas = false;

    while ($fila = $resultado->fetch_assoc()) {
        $pasas = true;
        $_SESSION['user'] = $fila['user'];
        
        
    }if($pasas == true){
        echo "Accediendo";
        echo '<meta http-equiv="Refresh" content="2; url=startupconnect.php" /> ';
        
    }else{
        echo "campos incorrectos";
        echo '<meta http-equiv="Refresh" content="2; url=index.php" /> ';
    }
    
    

?>