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
        <h1>AÑADIR SUCURSAL</h1>

        <form action="../../controllers/SucursalController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">DIRECCION:</th>
                    <td><input type="text" id="dir" name="dir" require placeholder="Digite la dirección"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO POSTAL:</th>
                    <td><input type="text" id="cod" name="cod" require placeholder="Digite el codigo postal"></td>
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
