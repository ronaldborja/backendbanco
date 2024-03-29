<?php
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";

$id = 1; 

//Datos de la sucursal: 
try {
    $suc = Sucursal::find($id); 
    echo "<b>DIRECCION: </b>$suc->direccion <br>";
    echo "<b>CODIGO POSTAL: </b> $suc->codigo_postal <br>";

    //Listar empleados
    $lista_empleados = $suc->empleados;
    $num_empleados = count($lista_empleados);
    echo "<br>";
    echo "EMPLEADOS: $num_empleados <br>"; 


    foreach ($lista_empleados as $i => $l) {
        echo "-----------------------------<br>";
        echo "Empleado N°".($i + 1)."<br>";
        echo "-----------------------------<br>";
        echo "<b>DNI</b> $l->dni<br>";
        echo "<b>NOMBRE</b> $l->nombre<br>";
        echo "<b>DIRECCION</b> $l->direccion<br>";
        echo "<b>TELEFONO</b> $l->telefono<br>";
        echo "<b>FECHA DE NACIMIENTO</b> $l->fecha_nacimiento<br>";
        echo "<b>SEXO</b> $l->sexo<br>";
    }
}

catch (Exception $error) {
    echo $error->getMessage();
}






?> 