<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Empleado.php";

class EmpleadoController { 
    //Métodos para gestionar peticiones desde la vista 
    public static function ejecutarAccion() {
        $accion  = @$_REQUEST["accion"];

        //Estructura de control 
        switch($accion) {
            case "Guardar": 
                //Método guardar
                EmpleadoController::guardar();
                break;

            case "Buscar":
                EmpleadoController::buscar();
                break;

            case "Editar":
                EmpleadoController::editar();
                break;

            case "Eliminar":
                EmpleadoController::eliminar();
                break;

            //case "Listar_todo":
              //  EmpleadoController::listar_todo();
               // break;

            default:
                header("Location: ../view/error.php?msg=Accion no permitida");
                exit;
        }
    }

    //Logica del método
    public static function guardar() {
        //Datos del form
        $DNI = @$_REQUEST["dni"];
        $nombre = @$_REQUEST["nombre"];
        $direccion = @$_REQUEST["dir"];
        $telefono = @$_REQUEST["cel"];
        $fecha_nacimiento = @$_REQUEST["fn"];
        $sexo = @$_REQUEST["sex"];
        $sucursal_id = @$_REQUEST["suc_id"];

        $e = new Empleado(); 
        $e->dni = $DNI; 
        $e->nombre = $nombre; 
        $e->direccion = $direccion; 
        $e->telefono = $telefono;
        $e->fecha_nacimiento = $fecha_nacimiento; 
        $e->sexo = $sexo; 
        $e->sucursal_id = $sucursal_id; 

        //Intentar guarda la sucursal en la bd
        try {
            $e->save();  #Operación guardar en ld bd
            $total = @Empleado::count(); #Conteo del total de sucursales
            $msg = "Empleado guardado, Total: $total";
            header("Location: ../view/empleado/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit;
        }

        catch(Exception $error) {
            if (strstr($error->getMessage(), "Duplicate")) {
                $msg = "El empleado ya fue ingresada al sistema";
            }

            else {
                $msg = "Ocurrió un error al guardar el empleado";
            }

            header("Location: ../view/empleado/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit; 
        }
    }

    public static function buscar() {
        $DNI = @$_REQUEST["dni"];

        //Intentamos buscar la sucursal en la bd 
        try { 
            $e = Empleado::find($DNI);

            //Colocamos la sucursal en la sesion creada
            $_SESSION["empleado.find"] = serialize($e);
            $msg = "Empleado encontrado"; 

            //Redir a la pagina buscar enviandole un mensaje 
            header("Location: ../view/empleado/buscar.php?msg=$msg");
            exit;
        }

        catch (Exception $error){
            if (strstr($error->getMessage(), $DNI)) {
                $msg = "El empleado no existe";
            }

            else {
                $msg = "Ocurrio un error al encontrar el empleado";
            }

            $_SESSION["empleado.find"] = NULL; 
            header("Location: ../view/empleado/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function editar() {
        //Primero se busca la sucursal
        $DNI = @$_REQUEST["dni"];

        //Obtener la sucursal guardado en sesion 
        $e = @$_SESSION["empleado.find"]; 

        //Convertir a objeto
        $e = unserialize($e); 

        if ($e->dni != $DNI) {
            $msg = "El dni no corresponde al empleado consultado"; 
            header("Location: ../view/empleado/buscar.php?msg=$msg");
        }

        //Nuevos campos en el formulario
        $nombre = @$_REQUEST["nombre"];
        $direccion = @$_REQUEST["dir"];
        $telefono = @$_REQUEST["cel"];
        $fecha_nacimiento = @$_REQUEST["fn"];
        $sexo = @$_REQUEST["sex"];
        $sucursal_id = @$_REQUEST["suc_id"];

        //Lo colocamos en la sucursal buscada
        $e->nombre = $nombre; 
        $e->direccion = $direccion; 
        $e->telefono = $telefono;
        $e->fecha_nacimiento = $fecha_nacimiento; 
        $e->sexo = $sexo; 
        $e->sucursal_id = $sucursal_id; 

        try { 
            //Guardar la sucursal con los datos actualizados 
            $e->save(); 

            //Serializamos el sucursal nuevamente y lo guardamos en la sesión 
            $_SESSION["empleado.find"] = serialize($e); 
            $msg = "Empleado editado"; 

            header("Location: ../view/empleado/buscar.php?msg=$msg");
            exit; 

        } catch (Exception $error) {
            if (strstr($error->getMessage(), $DNI)) {
                $msg = "El empleado no existe"; 
            }

            else {
                $msg = "Se encontró un error al editar el empleado";
            }

            $_SESSION["empleado.find"] = NULL;
            header("Location: ../view/empleado/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function eliminar() {
        //Primero se busca la sucursal
        $DNI = @$_REQUEST["dni"];

        //Obtener la sucursal  guardado en sesion 
        $e = @$_SESSION["empleado.find"]; 

        //Convertir a objeto
        $e = unserialize($e); 

        if ($e->dni != $DNI) {
            $msg = "El codigo no corresponde a la empleado consultado"; 
            header("Location: ../view/empleado/buscar.php?msg=$msg");
        }

        try {
            $e->delete(); 
            //Eliminamos la sesion de esta sucursal 
            $e = @$_SESSION["empleado.find"] = null; 
            $total = @Empleado::count(); 
            $msg = "Empleado eliminado, Total: $total"; 

            header("Location: ../view/empleado/buscar.php?msg=$msg");
            exit; 
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $DNI)) {
                $msg = "El empleado no existe"; 
            }

            else {
                $msg = "Se encontró un error al eliminar el empleado";
            }

            $_SESSION["empleado.find"] = NULL;
            header("Location: ../view/empleado/buscar.php?msg=$msg");
            exit;
        }

    }

}

EmpleadoController::ejecutarAccion();
?>