<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";

$suc = new Sucursal(); 
$suc->direccion = "Colombia";
$suc->codigo_postal = "232050";

$suc->save();
$total = Sucursal::count();
echo "TOTAL: $total registros"; 
?> 