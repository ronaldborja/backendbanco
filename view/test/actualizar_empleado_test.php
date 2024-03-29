<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";

$dni = 1210;

try {
    echo "<h1>Datos del cliente: </h1>";
    $emp = Empleado::find($dni);
    echo "<b>DNI:</b> $emp->dni <br>";
    echo "<b>NOMBRE:</b> $emp->nombre <br>"; 
    echo "<b>DIRECCION: </b> $emp->direccion<br>";
    echo "<b>TELEFONO: </b> $emp->telefono<br>";
    echo "<b>FECHA DE NACIMIENTO:</b> $emp->fecha_nacimiento<br>";
    echo "<b>SEXO: </b> $emp->sexo <br>";
    echo "<br>"; 

    echo "CAMBIANDO LA DIRECCION Y TELEFONO...";

    $emp->direccion = "Chocó";
    $emp->telefono = "3003056789";
    $emp->save(); 

    echo "<br>"; 
    echo "<h1>Datos actualizados del cliente:</h1>";
    echo "<b>DNI:</b> $emp->dni <br>";
    echo "<b>NOMBRE:</b> $emp->nombre <br>"; 
    echo "<b>DIRECCION: </b> $emp->direccion<br>";
    echo "<b>TELEFONO: </b> $emp->telefono<br>";
    echo "<b>FECHA DE NACIMIENTO:</b> $emp->fecha_nacimiento<br>";
    echo "<b>SEXO: </b> $emp->sexo <br>";

}
catch(Exception $error) {
    echo $error->getMessage();

}
?> 