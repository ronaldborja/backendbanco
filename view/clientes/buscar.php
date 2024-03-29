<?php
//Msg del controlador: 
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cliente.php";
    $msg = @$_REQUEST["msg"];
    $c = @$_SESSION["cliente.find"];
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
    <script src = "../js/validaciones_cliente.js"></script> 
</head>

<body>
    <center>
        <h1>BUSCAR CLIENTE</h1>

        <form action="../../controllers/ClienteController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO CLIENTE:</th>
                    <td><input type="text" id="id" name="id" 
                    value="<?= @$c->id?>" required placeholder="Codigo del cliente"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NOMBRE:</th>
                    <td><input type="text" id="nombre" name="nombre"
                    value="<?= @$c->nombre?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO CLIENTE NATURAL:</th>
                    <td><input type="text" id="nat" name="nat"
                    value="<?= @$c->cliente_natural_id?>">
                </td>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO ORGANIZACION:</th>
                    <td><input type="text" id="org" name="org"
                    value="<?= @$c->organizacion_id?>">
                </td>                    
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
