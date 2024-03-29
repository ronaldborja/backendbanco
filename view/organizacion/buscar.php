<?php
//Msg del controlador: 
    session_start();

    require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Organizacion.php";
    $msg = @$_REQUEST["msg"];
    $org = @$_SESSION["organizacion.find"];
    $org = unserialize($org); 
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
    <script src = "../js/validaciones_organizacion.js"></script> 
</head>

<body>
    <center>
        <h1>BUSCAR ORGANIZACION</h1>

        <form action="../../controllers/OrganizacionController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">COD CLIENTE:</th>
                    <td><input type="text" id="id" name="id" require placeholder="Digite el codigo del cliente"
                    value="<?= @$org->id?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NOMBRE:</th>
                    <td><input type="text" id="nombre" name="nombre"
                    value="<?= @$org->nombre?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">DIRECCION:</th>
                    <td><input type="text" id="dir" name="dir"
                    value="<?= @$org->direccion?>"></td>
                </tr>

                
                <tr>
                    <th style="text-align: right;" class="encabezado">REPRESENTANTE:</th>
                    <td><input type="text" id="rep" name="rep"
                    value="<?= @$org->representante?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">TIPO ORGANIZACION:</th>
                    <td><input type="text" id="tipo" name="tipo"
                    value="<?= @$org->tipo_organizacion?>"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NUMERO EMPLEADOS:</th>
                    <td><input type="text" id="numemp" name="numemp"
                    value="<?= @$org->num_empleados?>"></td>
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
        document.addEventListener("DOMContentLoaded", function() {
            habilitarBotones();
            confirmarOperacion();
        });
    </script>
</body>
</html>
