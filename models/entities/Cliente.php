<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";

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