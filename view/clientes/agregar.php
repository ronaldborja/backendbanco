<?php 
// Mensaje recibido -> Controller 
$msg = @$_REQUEST["msg"]; 
?> 

<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="with=device-with, initial-scale=1.0">
    <title>Sistema Bancario</title>
    <link rel="stylesheet" href="/backendbanco/view/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <center>
        <h1>AGREGAR CLIENTE</h1>

        <form action="../../controllers/ClienteController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">COD CUENTA:</th>
                    <td><input type="text" id="id" name="id" require placeholder="Digite el codigo clave de la cuenta"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NOMBRE:</th>
                    <td><input type="text" id="nombre" name="nombre" require placeholder="Nombre guardado"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO CLIENTE NATURAL:</th>
                    <td><input type="text" id="nat" name="nat" require placeholder="Codigo del cliente si es natural"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO ORGANIZACION:</th>
                    <td><input type="text" id="org" name="org" require placeholder="Codigo del cliente si es organización"></td>
                </tr>

                <tr>
                    <td>&nbsp</td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: right;" class="buttons">
                        <input type="submit" id="accion" name="accion" value="Guardar">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" id="clean" value="Limpiar">
                    </td>
                </tr>
            </table>
        </form>
        <span><?= ($msg != NULL || isset($msg)) ? $msg : "" ?></span>
    </center>
</body>
</html>
