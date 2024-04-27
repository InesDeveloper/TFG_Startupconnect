<?php
    //$enlace = mysqli_connect("localhost", "startupconnect", "startupconnect", "startupconnect");

class ControladorBD {

    private $enlace;

    private $host;
    private $usuario;
    private $clave;
    private $nombre;

    /** Constructor */
    public function __construct() {
        $this->host = "localhost";
        $this->usuario = "startupconnect";
        $this->clave = "startupconnect";
        $this->nombre = "startupconnect";
    }
    
    public function conectar() {
        $this->link = new mysqli($this->host, $this->usuario, $this->clave, $this->nombre);

        if ($this->link->connect_errno) {
            return FALSE;
        }

        return TRUE;
    }
    
    public function consulta($query) {
        if($this->conectar()) {
            
            if (($resultado = $this->link->query($query))) {
                if (is_object($resultado)) {
                    return $this->obtenerResultados($resultado);    // Si la consulta devuelve objetos, obtener el resultado
                } else {
                    return TRUE;                                    // En caso de que no devuelva nada, TRUE para indicar que ha funcionado
                }
            }
            $this->desconectar();                                   // Desconecto el enlace de la base de datos para liberar recursos
            return FALSE;                                           // Si ha fallado la consulta, devuelvo FALSE
            
        } else {
            return FALSE;                                           // Si ha fallado la conexión, devuelvo FALSE
        }
    }
    
    private function obtenerResultados(mysqli_result &$resultado) {
        $resultados = array();

        while ($fila = $resultado->fetch_assoc()) {
            $resultados[] = $fila;
        }

        $resultado->free();
        $this->desconectar();
        
        return $resultados;
    }
    
    public function desconectar() {
        if (is_resource($this->link)) {
            return $this->link->close();
        }

        return FALSE;
    }
    
    public function __destruct() {
        $this->desconectar();
    }
}
?>

