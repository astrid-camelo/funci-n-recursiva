<?php
require('config.php');

/**
 * Clase para conexión a Base de Datos
 */
class Conexion
{
    protected $db;

    public function __construct()
    {
        // Intentamos conectar a la base de datos
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificamos si hubo un error en la conexión
        if ($this->db->connect_error) {
            // Si hay un error, mostramos un mensaje y detenemos la ejecución
            die("Error de conexión: " . $this->db->connect_error);
        }

        // Establecemos la codificación de caracteres
        $this->db->set_charset(DB_CHARSET);
    }
}
?>
