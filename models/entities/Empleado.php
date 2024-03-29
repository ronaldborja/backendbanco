<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";

class Empleado extends ActiveRecord\Model {
    public static $primary_key = "dni"; 
    public static $table_name = "empleados";
    public static $belongs_to = array(array("Sucursal"));
}




?> 