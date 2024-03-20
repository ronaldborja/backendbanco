<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";

class Banco extends ActiveRecord\Model {
    public static $primary_key = "id"; 
    public static $table_name = "banco";
    public static $has_many = array(
        array("Cuentas")
    );


}




?> 