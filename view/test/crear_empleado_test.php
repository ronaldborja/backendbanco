<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";

$empl = new Empleado(); 
$empl->dni = 1210;
$empl->nombre = "Carmelo Berrio";
$empl->direccion = "Medellin"; 
$empl->telefono = "3107082456";
$empl->fecha_nacimiento = '1971-28-06';
$empl->sexo = "Masculino";
$empl->sucursal_id = 1; 


$empl->save();
$total_emp = Empleado::count();
echo "Empleado guardado";
echo "TOTAL: $total_emp registros";  

?> 
