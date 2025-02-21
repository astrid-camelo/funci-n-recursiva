<?php

    class serverSoap 
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

    }

    $opcions = array("uri"=>"http://localhost/webservices/appwebservices");
    $server = new SoapServer(NULL,$opcions);
    $server->setClass("serverSoap");
    $server->handle();
	
?>