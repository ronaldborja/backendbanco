<?php
//Msg del controlador: 
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cuenta.php";
    $msg = @$_REQUEST["msg"];
    $c = @$_SESSION["cuenta.find"];
    $c = unserialize($c); 
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
    <script src = "../js/validaciones_cuenta.js"></script> 
</head>

<body>
    <center>
        <h1>BUSCAR CUENTAS</h1>

        <form action="../../controllers/CuentaController.php" method="POST">
            <table>

                <tr>
                    <th style="text-align: right;" class="encabezado">COD CUENTA:</th>
                    <td><input type="text" id="id" name="id" require placeholder="Digite el codigo clave de la cuenta"
                    value = "<?= @$c->id ?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">TIPO DE CUENTA:</th>
                    <td><input type="text" id="tipo" name="tipo"
                    value = "<?= @$c->tipo_cuenta?>"></td>
                </tr>


                <tr>
                    <th style="text-align: right;" class="encabezado">SALDO ACTUAL:</th>
                    <td><input type="text" id="actual" name="actual"
                    value = "<?= @$c->saldo_actual?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">SALDO MEDIO:</th>
                    <td><input type="text" id="medio" name="medio"
                    value = "<?= @$c->saldo_medio?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NUMERO DE CUENTA:</th>
                    <td><input type="text" id="numero_cuenta" name="numero_cuenta" 
                    value = "<?= @$c->numero_cuenta?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">FECHA APERTURA:</th>
                    <td><input type="text" id="fecha_apertura" name="fecha_apertura"
                    value = "<?= @$c->fecha_apertura?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO SUCURSAL:</th>
                    <td><input type="text" id="sucursal_id" name="sucursal_id"
                    value = "<?= @$c->sucursal_id?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO CLIENTE:</th>
                    <td><input type="text" id="cliente_id" name="cliente_id"
                    value = "<?= @$c->cliente_id?>"></td>
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
