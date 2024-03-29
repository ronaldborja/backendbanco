<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cuenta.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";


class Sucursal extends ActiveRecord\Model {
    public static $primary_key = "id"; 
    public static $table_name = "sucursales";
    public static $has_many = array(
        array("Cuentas"),
        array("Empleados")
    );
    

    


}




?> 