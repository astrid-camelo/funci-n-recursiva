<?php
	$options = array (
        "location" => "http://localhost/webservices/appwebservices/server.php",
        "uri" => "http://localhost/webservices/appwebservices/"
    );
    $client = new SoapClient (NULL,$options);
    $nombre = "usuario";

    echo $client->saludar($nombre ."!!") . "</br/>";
    echo "El resultado de la Suma: " . $client->operacion(20, 5, 'suma') . "<br>";
    echo "El resultado de la Resta: " . $client->operacion(9, 3, 'resta') . "<br>"; 
    echo "El resultado de la Multiplicación: " . $client->operacion(4, 7, 'multiplicacion') . "<br>"; 
    echo "El resultado de la División: " . $client->operacion(12, 5, 'division') . "<br>"; 
    echo "<br>";
    echo "El resultado de la Suma recursiva: " . $client->operacion(20, 5, 'suma') . "<br>";
    echo "El resultado de la Resta recursiva: " . $client->operacion(9, 3, 'resta') . "<br>"; 
    echo "El resultado de la Multiplicación recursiva: " . $client->operacion(4, 7, 'multiplicacion') . "<br>"; 
    echo "El resultado de la División recursiva: " . $client->operacion(12, 5, 'division') . "<br>"; 
    echo "<br>";
    echo "El producto es: " .$client->getProduct();
    echo "<br>";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $resultado = $client->validarUsuario($nombre, $clave);
        echo $resultado; 
    }
?>
<form method="POST" action=""> <br>
    <label for="nombre">nombre:</label>
    <input type="text" name="nombre" id="nombre" required><br>
    <label for="clave">Clave:</label>
    <input type="password" name="clave" id="clave" required><br>
    <input type="submit" value="Iniciar sesión">
</form>

