<?php
    require('conexion.php');
    class serverSoap extends conexion
    {
        public function saludar($name)
        {
            return "hola " .$name."!";
        }
        public function suma_normal($num1, $num2)
    {
        return $num1 + $num2;
    }

    public function resta_normal($num1, $num2)
    {
        return $num1 - $num2;
    }

    public function multiplicacion_normal($num1, $num2)
    {
        return $num1 * $num2;
    }

    public function division_normal($num1, $num2)
    {
        if ($num2 == 0) {
            return "Error: División por cero.";
        }
        return $num1 / $num2;
    }

    // Funciones recursivas
    public function suma_recursiva($num1, $num2)
    {
        if ($num2 == 0) {
            return $num1;
        }
        return $this->suma_recursiva($num1 + 1, $num2 - 1);
    }

    public function resta_recursiva($num1, $num2)
    {
        if ($num2 == 0) {
            return $num1;
        }
        return $this->resta_recursiva($num1 - 1, $num2 - 1);
    }

    public function multiplicacion_recursiva($num1, $num2)
    {
        if ($num2 == 0) {
            return 0;
        }
        return $num1 + $this->multiplicacion_recursiva($num1, $num2 - 1);
    }

    public function division_recursiva($num1, $num2, $contador = 0)
    {
        if ($num1 < $num2) {
            return $contador;
        }
        return $this->division_recursiva($num1 - $num2, $num2, $contador + 1);
    }

    // Operación general para invocar funciones normales o recursivas
    public function operacion($num1, $num2, $tipoOperacion, $modo = 'normal')
    {
        if ($modo == 'normal') {
            switch ($tipoOperacion) {
                case 'suma':
                    return $this->suma_normal($num1, $num2);
                case 'resta':
                    return $this->resta_normal($num1, $num2);
                case 'multiplicacion':
                    return $this->multiplicacion_normal($num1, $num2);
                case 'division':
                    return $this->division_normal($num1, $num2);
                default:
                    return "Operación no válida.";
            }
        } else {
            switch ($tipoOperacion) {
                case 'suma':
                    return $this->suma_recursiva($num1, $num2);
                case 'resta':
                    return $this->resta_recursiva($num1, $num2);
                case 'multiplicacion':
                    return $this->multiplicacion_recursiva($num1, $num2);
                case 'division':
                    return $this->division_recursiva($num1, $num2);
                default:
                    return "Operación no válida.";
            }
        }
    }

    public function getProduct(){
        $query = "SELECT * FROM producto";
        $result = mysqli_query($this->db, $query);
        while($row = mysqli_fetch_assoc ($result))
        {
            return $row['nombre'];
        }

        $result->close();
    }
    public function validarUsuario($nombre, $clave)
    {
        // Comprobamos que la conexión a la base de datos se haya realizado correctamente
        if (!$this->db) {
            return "Error de conexión a la base de datos. Intenta más tarde.";
        }

        // Preparamos la consulta SQL para buscar el usuario y clave
        $query = "SELECT * FROM usuarios WHERE nombre = ? AND clave = ?";
        $stmt = $this->db->prepare($query);

        // Verificamos si hubo un error al preparar la consulta
        if ($stmt === false) {
            return "Error al preparar la consulta SQL: " . $this->db->error;
        }

        // Vinculamos los parámetros
        $stmt->bind_param("ss", $nombre, $clave);

        // Ejecutamos la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Si el resultado tiene filas, es porque el usuario y la clave coinciden
        if ($result->num_rows > 0) {
            return "Los datos ingresados son válidos.";
        } else {
            return "Los datos ingresados no coinciden, intente de nuevo.";
        }
    }   
}

    $opcions = array("uri"=>"http://localhost/webservices/appwebservices");
    $server = new SoapServer(NULL,$opcions);
    $server->setClass("serverSoap");
    $server->handle();
	
?>