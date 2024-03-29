<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";

$dni = 1210;

try {
    $lista_empleados = Empleado::all(); 
    $num_usuarios = count($lista_empleados);
    echo "<h2><b>TOTAL USUARIOS: </b>$num_usuarios </h2><br>";
    echo "<h3><br>Eliminación del usuario con DNI 12120<hr><br>";

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

    //Eliminación del empleado 
    Empleado::find($dni)->delete();

    //Nueva lista de empleados: 
    $lista_empleados = Empleado::all();
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
        echo "<br>";
    }


}
catch (Exception $error) {
    echo $error->getMessage();
}