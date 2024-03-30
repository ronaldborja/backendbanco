<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cliente.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cuenta.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/ClienteNatural.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Organizacion.php";

class Cliente extends ActiveRecord\Model {
    public static $primary_key = "id"; 
    public static $table_name = "clientes";
    public static $belongs_to = array(
        array("Organizacion"), 
        array("ClienteNatural"),
        array("Cuenta")
    );

}
?> 