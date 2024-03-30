<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";

class ClienteNatural extends ActiveRecord\Model {
    public static $primary_key = "id"; 
    public static $table_name = "clientes_naturales";
}
?> 