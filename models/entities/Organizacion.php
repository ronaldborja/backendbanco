<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/config.php";

class Organizacion extends ActiveRecord\Model {
    public static $primary_key = "id"; 
    public static $table_name = "organizaciones";
}
?> 