<?php

//Msg del controlador: 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";
$msg = @$_REQUEST["msg"];
$suc = @$_SESSION["sucursal.all"];
$suc = unserialize($suc);
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
        <h1>REPORTE DE SUCURSALES</h1>
        <hr>
        <?php
        if (count($suc) <= 0) { 
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen usuarios registrados
            </span>
        <?php
        } else { 
        ?>
            <fieldset style="width: 30%">
                <legend>Información sucursales: </legend>
                <table>
                    <tr>
                        <th>#</th>
                        <th>CODIGO POSTAL</th>
                        <th>DIRECCION</th>
                    </tr>

                    <?php 
                    $suc = Sucursal::find('all');
                    foreach ($suc as $s => $sucursal) { 
                    ?> 
                        <tr style="text-align: left;">
                            <td><?=($s+1) ?></td>
                            <td><?=($sucursal->codigo_postal) ?></td>
                            <td><?=($sucursal->direccion) ?></td>
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