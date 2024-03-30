<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";

class Cuenta extends ActiveRecord\Model {
    public static $primary_key = "id"; 
    public static $table_name = "cuentas";
    public static $belongs_to = array(
        array("Sucursal"),
        array("Banco"),
        array("Cliente")
    );
}
?> 