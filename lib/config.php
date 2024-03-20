<?php
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/lib/orm/ActiveRecord.php";

ActiveRecord\Config::initialize(function($cfg)
{
   $cfg->set_model_directory($_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities");
   $cfg->set_connections(
     array(
       'development' => 'mysql://root:root@localhost/sistemabancario'
       //'test' => 'mysql://username:password@localhost/test_database_name',
       //'production' => 'mysql://username:password@localhost/production_database_name'
     )
   );
});

?>