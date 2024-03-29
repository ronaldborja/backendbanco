<?php

//Msg del controlador: 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cliente.php";
$msg = @$_REQUEST["msg"];
$c = @$_SESSION["cliente.all"];
$c = unserialize($c);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="with=device-with, initial-scale=1.0">
    <title>Sistema Bancario</title>
    <link rel="stylesheet" href="/backendbanco/view/css/styles_listar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <center>
        <h1>REPORTE DE CLIENTE</h1>
        <hr>
        <?php
        if (count($c) <= 0) { 
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen clientes registrados
            </span>
        <?php
        } else { 
        ?>
            <fieldset style="width: 40%">
                <legend>Información cliente: </legend>
                <table>
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>CLIENTE NATURAL</th>
                        <th>ORGANIZACION</th>
                    </tr>

                    <?php 
                    $c = Cuenta::find('all');
                    foreach ($c as $i => $cliente) { 
                    ?> 
                        <tr style="text-align: left;">
                            <td><?=($i+1) ?></td>
                            <td><?=($cliente->nombre) ?></td>
                            <td><?=($cliente->cliente_natural_id) ?></td>
                            <td><?=($cliente->organizacion_id) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </fieldset>
        <?php
        }
        ?>

        <span style="color:red;"><?=($msg != NULL || isset($msg)) ? $msg : "" ?></span>

    </center>