<?php

//Msg del controlador: 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/ClienteNatural.php";
$msg = @$_REQUEST["msg"];
$nat = @$_SESSION["natural.all"];
$nat = unserialize($nat);
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
        <h1>REPORTE DE CLIENTES NATURALES</h1>
        <hr>
        <?php
        if (count($nat) <= 0) { 
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen clientes naturales registrados
            </span>
        <?php
        } else { 
        ?>
            <fieldset style="width: 70%">
                <legend>Información clientes naturales: </legend>
                <table>
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>DIRECCION</th>
                        <th>FECHA NACIMIENTO</th>
                        <th>SEXO</th>
                    </tr>

                    <?php 
                    $cn = ClienteNatural::find('all');
                    foreach ($cn as $c => $clientenatural) { 
                    ?> 
                        <tr style="text-align: left;">
                            <td><?=($c+1) ?></td>
                            <td><?=($clientenatural->nombre) ?></td>
                            <td><?=($clientenatural->direccion) ?></td>
                            <td><?=($clientenatural->fecha_nacimiento) ?></td>
                            <td><?=($clientenatural->sexo) ?></td>
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