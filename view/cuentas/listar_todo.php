<?php

//Msg del controlador: 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cuenta.php";
$msg = @$_REQUEST["msg"];
$c = @$_SESSION["cuenta.all"];
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
        <h1>REPORTE DE CUENTAS</h1>
        <hr>
        <?php
        if (count($c) <= 0) { 
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen cuentas registradas
            </span>
        <?php
        } else { 
        ?>
            <fieldset style="width: 70%">
                <legend>Información cuentas: </legend>
                <table>
                    <tr>
                        <th>#</th>
                        <th>TIPO CUENTA</th>
                        <th>SALDO ACTUAL</th>
                        <th>SALDO MEDIO</th>
                        <th>NUMERO DE CUENTA</th>
                        <th>FECHA DE APERTURA</th>
                        <th>CODIGO SUCURSAL</th>
                        <th>CODIGO CLIENTE</th>
                    </tr>

                    <?php 
                    $c = Cuenta::find('all');
                    foreach ($c as $i => $cuenta) { 
                    ?> 
                        <tr style="text-align: left;">
                            <td><?=($i+1) ?></td>
                            <td><?=($cuenta->tipo_cuenta) ?></td>
                            <td><?=($cuenta->saldo_actual) ?></td>
                            <td><?=($cuenta->saldo_medio) ?></td>
                            <td><?=($cuenta->numero_cuenta) ?></td>
                            <td><?=($cuenta->fecha_apertura) ?></td>
                            <td><?=($cuenta->sucursal_id) ?></td>
                            <td><?=($cuenta->cliente_id) ?></td>
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