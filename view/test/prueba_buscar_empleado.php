<?php
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";

$dni = 1212; 

try {
    echo "<h1>Datos del cliente: </h1>";
    $emp = Empleado::find($dni);
    echo "<b>DNI:</b> $emp->dni <br>";
    echo "<b>NOMBRE:</b> $emp->nombre <br>"; 
    echo "<b>DIRECCION: </b> $emp->direccion<br>";
    echo "<b>TELEFONO: </b> $emp->telefono<br>";
    echo "<b>FECHA DE NACIMIENTO:</b> $emp->fecha_nacimiento<br>";
    echo "<b>SEXO: </b> $emp->sexo <br>";
    
    $suc = Sucursal::find($emp->sucursal_id);
    
    echo "<b>SUCURSAL: </b> $suc->direccion <br>";
}
catch (Exception $error) {
    echo $error->getMessage();
}



?> 