<?php
$msg = @$_REQUEST["msg"]; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h1>MENSAJE ERROR</h1>
        <hr>
        <span style="color: #900D40; background-color: #FAD7CE;">
        <?= ($msg != NULL || isset($msg)) ? $msg: " " ?>
        </span>
    </center>
    
</body>
</html>