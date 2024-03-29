<?php
//Msg del controlador: 
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/ClienteNatural.php";
    $msg = @$_REQUEST["msg"];
    $cn = @$_SESSION["natural.find"];
    $cn = unserialize($cn); 
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
    <script src = "../js/validaciones_cliente_natural.js"></script> 
</head>

<body>
    <center>
        <h1>BUSCAR CLIENTE NATURAL</h1>

        <form action="../../controllers/NaturalesController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">COD CLIENTE:</th>
                    <td><input type="text" id="id" name="id" 
                    value="<?= @$cn->id?>" required placeholder="Codigo del cliente"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NOMBRE:</th>
                    <td><input type="text" id="nombre" name="nombre"
                    value="<?= @$cn->nombre?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">DIRECCION:</th>
                    <td><input type="text" id="dir" name="dir"
                    value="<?= @$cn->direccion?>">
                </td> 
                </tr>
                
                <tr>
                    <th style="text-align: right;" class="encabezado">FECHA NACIMIENTO:</th>
                    <td><input type="text" id="fn" name="fn"
                    value="<?= @$cn->fecha_nacimiento?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">SEXO:</th>
                    <td><input type="text" id="sex" name="sex"
                    value="<?= @$cn->sexo?>"></td>
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
