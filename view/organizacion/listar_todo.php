<?php

//Msg del controlador: 
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Organizacion.php";
$msg = @$_REQUEST["msg"];
$org = @$_SESSION["organizacion.all"];
$org = unserialize($org);
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
        <h1>REPORTE DE ORGANIZACIONES</h1>
        <hr>
        <?php
        if (count($org) <= 0) { 
        ?>
            <span style="color: #900D40; background-color: #FAD7CE;">
                No existen organizaciones registrados
            </span>
        <?php
        } else { 
        ?>
            <fieldset style="width: 70%">
                <legend>Información organizaciones: </legend>
                <table>
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>DIRECCION</th>
                        <th>TIPO DE ORGANIZACION</th>
                        <th>REPRESENTANTE</th>
                        <th>NUMERO DE EMPLEADOS</th>
                    </tr>

                    <?php 
                    $org = Organizacion::find('all');
                    foreach ($org as $o => $organizacion) { 
                    ?> 
                        <tr style="text-align: left;">
                            <td><?=($o+1) ?></td>
                            <td><?=($organizacion->nombre) ?></td>
                            <td><?=($organizacion->direccion) ?></td>
                            <td><?=($organizacion->tipo_organizacion) ?></td>
                            <td><?=($organizacion->representante) ?></td>
                            <td><?=($organizacion->num_empleados) ?></td>
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