<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";

$suc = new Sucursal(); 
$suc->direccion = "Colombia";
$suc->codigo_postal = "232050";


try {
    $suc->save();
    $total = Sucursal::count();
    echo "Sucursal guardada";
    echo "TOTAL: $total registros";     
}

catch (Exception $error) {
    $msg = $error->getMessage();
    if (strstr($msg, "Duplicate")) {
        echo "El usuario ya existe";
    }
}


?> 

