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
        <h1>AÑADIR ORGANIZACION</h1>

        <form action="../../controllers/OrganizacionController.php" method="POST">
            <table>
                <tr>
                    <th style="text-align: right;" class="encabezado">COD CLIENTE:</th>
                    <td><input type="text" id="id" name="id" require placeholder="Digite el codigo del cliente"></td>
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
                    <th style="text-align: right;" class="encabezado">TIPO DE ORGANIZACION:</th>
                    <td><input type="text" id="tipo" name="tipo" require placeholder="Digite el tipo de org"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">REPRESENTANTE</th>
                    <td><input type="text" id="rep" name="rep" require placeholder="Digite el representante"></td>
                </tr>

                <tr>
                    <th style="text-align: right;" class="encabezado">NUMERO DE EMPLEADOS</th>
                    <td><input type="text" id="numempl" name="numemp" require placeholder="Digite el numero de empleados"></td>
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