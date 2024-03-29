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
        <h1>CREAR CUENTA</h1>

        <form action="../../controllers/CuentaController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">COD CUENTA:</th>
                    <td><input type="text" id="id" name="id" require placeholder="Digite el codigo clave de la cuenta"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">TIPO DE CUENTA:</th>
                    <td><input type="text" id="tipo" name="tipo" require placeholder="Saldo actual de la cuenta"></td>
                </tr>


                <tr>
                    <th style="text-align: right;" class="encabezado">SALDO ACTUAL:</th>
                    <td><input type="text" id="actual" name="actual" require placeholder="Saldo actual de la cuenta"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">SALDO MEDIO:</th>
                    <td><input type="text" id="medio" name="medio" require placeholder="Saldo medio de la cuenta"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NUMERO DE CUENTA:</th>
                    <td><input type="text" id="numero_cuenta" name="numero_cuenta" require placeholder="Numero de la cuenta"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">FECHA APERTURA:</th>
                    <td><input type="text" id="fecha_apertura" name="fecha_apertura" require placeholder="Fecha de apertura"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO SUCURSAL:</th>
                    <td><input type="text" id="sucursal_id" name="sucursal_id" require placeholder="Codigo de la sucursal"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO CLIENTE:</th>
                    <td><input type="text" id="cliente_id" name="cliente_id" require placeholder="Codigo del cliente"></td>
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
