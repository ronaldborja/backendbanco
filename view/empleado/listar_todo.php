<?php

//Msg del controlador: 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";
$msg = @$_REQUEST["msg"];
$nat = @$_SESSION["empleado.all"];
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
        <h1>REPORTE DE EMPLEADOS</h1>
        <hr>
        <?php
        if (count($nat) <= 0) { 
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen empleados registrados
            </span>
        <?php
        } else { 
        ?>
            <fieldset style="width: 70%">
                <legend>Información empleados: </legend>
                <table>
                    <tr>
                        <th>#</th>
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>DIRECCION</th>
                        <th>TELEFONO</th>
                        <th>FECHA NACIMIENTO</th>
                        <th>SEXO</th>
                        <th>CODIGO SUCURSAL</th>
                    </tr>

                    <?php 
                    $e = Empleado::find('all');
                    foreach ($e as $i => $empleado) { 
                    ?> 
                        <tr style="text-align: left;">
                            <td><?=($i+1) ?></td>
                            <td><?=($empleado->dni) ?></td>
                            <td><?=($empleado->nombre) ?></td>
                            <td><?=($empleado->direccion) ?></td>
                            <td><?=($empleado->telefono) ?></td>
                            <td><?=($empleado->fecha_nacimiento) ?></td>
                            <td><?=($empleado->sexo) ?></td>
                            <td><?=($empleado->sucursal_id) ?></td>
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