<?php
//Msg del controlador: 
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";
    $msg = @$_REQUEST["msg"];
    $suc = @$_SESSION["sucursal.find"];
    $suc = unserialize($suc); 
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
    <script src = "../js/validaciones.js"></script> 
</head>

<body>
    <center>
        <h1>BUSCAR SUCURSAL</h1>

        <form action="../../controllers/SucursalController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">Id:</th>
                    <td><input type="text" id="id" name="id" 
                    value="<?= @$suc->id?>" required placeholder="Codigo sucursal"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO POSTAL:</th>
                    <td><input type="text" id="cod" name="cod" readonly
                    value="<?= @$suc->codigo_postal?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">DIRECCION:</th>
                    <td><input type="text" id="dir" name="dir" readonly
                    value="<?= @$suc->direccion?>"></td>
                </tr>

                <tr>
                    <td>&nbsp</td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: right;" class="buttons">
                        <input type="submit" id="accion" name="accion" value="Buscar">&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="reset" id="clean" value="Limpiar">
                        <input type="submit" id="editar" name="accion" value="Editar" disabled>
                        <input type="submit" id="eliminar" name="accion" value="Eliminar" disabled>

                    </td>
                </tr>
            </table>
        </form>
        <span><?= ($msg != NULL || isset($msg)) ? $msg : "" ?></span>
    </center>
    <script>
        habilitarBotones();
        confirmarOperacion();
    </script>
</body>
</html>
