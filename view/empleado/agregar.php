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
        <h1>AÑADIR EMPLEADO</h1>

        <form action="../../controllers/EmpleadoController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">DNI:</th>
                    <td><input type="text" id="dni" name="dni" require placeholder="Digite la dirección"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NOMBRE:</th>
                    <td><input type="text" id="nombre" name="nombre" require placeholder="Digite el nombre"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">DIRECCION:</th>
                    <td><input type="text" id="dir" name="dir" require placeholder="Digite la dirección"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">TELEFONO:</th>
                    <td><input type="text" id="cel" name="cel" require placeholder="Digite el telefono"></td>
                </tr>

                
                <tr>
                    <th style="text-align: right;" class="encabezado">FECHA NACIMIENTO:</th>
                    <td><input type="text" id="fn" name="fn" require placeholder="Digite la fecha de nac"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">SEXO:</th>
                    <td><input type="text" id="sex" name="sex" require placeholder="Digite el sexo"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">CODIGO SUCURSAL:</th>
                    <td><input type="text" id="suc_id" name="suc_id" require placeholder="Digite la sucursal a la que pertenece"></td>
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
