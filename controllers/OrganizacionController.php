<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Organizacion.php";

class OrganizacionController { 
    //Métodos para gestionar peticiones desde la vista 
    public static function ejecutarAccion() {
        $accion  = @$_REQUEST["accion"];

        //Estructura de control 
        switch($accion) {
            case "Guardar": 
                //Método guardar
                OrganizacionController::guardar();
                break;

            case "Buscar":
                OrganizacionController::buscar();
                break;

            case "Editar":
                OrganizacionController::editar();
                break;

            case "Eliminar":
                OrganizacionController::eliminar();
                break;

            //case "Listar_todo":
              //  SucursalController::listar_todo();
               // break;

            default:
                header("Location: ../view/error.php?msg=Accion no permitida");
                exit;
        }
    }

    //Logica del método
    public static function guardar() {
        //Datos del form
        $id = @$_REQUEST["id"];
        $tipo_organizacion = @$_REQUEST["tipo"];
        $representante = @$_REQUEST["rep"]; 
        $nempleados = @$_REQUEST["numemp"];
        $nombre = @$_REQUEST["nombre"];
        $direccion = @$_REQUEST["dir"];

        $org = new Organizacion(); 
        $org->id = $id;
        $org->tipo_organizacion = $tipo_organizacion; 
        $org->representante = $representante; 
        $org->num_empleados = $nempleados; 
        $org->nombre = $nombre; 
        $org->direccion = $direccion; 

        //Intentar guarda la sucursal en la bd
        try {
            $org->save();  #Operación guardar en ld bd
            $total = @Organizacion::count(); #Conteo del total de sucursales
            $msg = "Organizacion guardada, Total: $total";
            header("Location: ../view/organizacion/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit;
        }

        catch(Exception $error) {
            if (strstr($error->getMessage(), "Duplicate")) {
                $msg = "La organizacion ya fue ingresada al sistema";
            }

            else {
                $msg = "Ocurrió un error al guardar la organizacion";
            }

            header("Location: ../view/organizacion/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit; 
        }
    }

    public static function buscar() {
        $id = @$_REQUEST["id"];

        //Intentamos buscar la sucursal en la bd 
        try { 
            $org = Organizacion::find($id);

            //Colocamos la sucursal en la sesion creada
            $_SESSION["organizacion.find"] = serialize($org);
            $msg = "Organizacion encontrada"; 

            //Redir a la pagina buscar enviandole un mensaje 
            header("Location: ../view/organizacion/buscar.php?msg=$msg");
            exit;
        }

        catch (Exception $error){
            if (strstr($error->getMessage(), $id)) {
                $msg = "La organización no existe";
            }

            else {
                $msg = "Ocurrio un error al guardar la organización";
            }

            $_SESSION["organizacion.find"] = NULL; 
            header("Location: ../view/organizacion/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function editar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal guardado en sesion 
        $org = @$_SESSION["organizacion.find"]; 

        //Convertir a objeto
        $org = unserialize($org); 

        if ($org->id != $id) {
            $msg = "El codigo no corresponde a la organizacion consultada"; 
            header("Location: ../view/organizacion/buscar.php?msg=$msg");
        }

        //Datos del form
        $tipo_organizacion = @$_REQUEST["tipo"];
        $representante = @$_REQUEST["rep"]; 
        $nempleados = @$_REQUEST["numemp"];
        $nombre = @$_REQUEST["nombre"];
        $direccion = @$_REQUEST["dir"];

        $org->tipo_organizacion = $tipo_organizacion; 
        $org->representante = $representante; 
        $org->num_empleados = $nempleados; 
        $org->nombre = $nombre; 
        $org->direccion = $direccion; 

        try { 
            //Guardar la sucursal con los datos actualizados 
            $org->save(); 

            //Serializamos el sucursal nuevamente y lo guardamos en la sesión 
            $_SESSION["organizacion.find"] = serialize($org); 
            $msg = "Organizacion editada"; 

            header("Location: ../view/organizacion/buscar.php?msg=$msg");
            exit; 

        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "El cliente no existe"; 
            }

            else {
                $msg = "Se encontró un error al editar el la organizacion";
            }

            $_SESSION["organizacion.find"] = NULL;
            header("Location: ../view/organizacion/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function eliminar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal  guardado en sesion 
        $org = @$_SESSION["organizacion.find"]; 

        //Convertir a objeto
        $org = unserialize($org); 

        if ($org->id != $id) {
            $msg = "El codigo no corresponde a la organizacion consultada"; 
            header("Location: ../view/organizacion/buscar.php?msg=$msg");
        }

        try {
            $org->delete(); 
            //Eliminamos la sesion de esta sucursal 
            $org = @$_SESSION["organizacion.find"] = null; 
            $total = @Organizacion::count(); 
            $msg = "Organizacion eliminada, Total: $total"; 

            header("Location: ../view/organizacion/buscar.php?msg=$msg");
            exit; 
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "La organizacion no existe"; 
            }

            else {
                $msg = "Se encontró un error al eliminar la organizacion";
            }

            $_SESSION["organizacion.find"] = NULL;
            header("Location: ../view/organizacion/buscar.php?msg=$msg");
            exit;
        }

    }

}

OrganizacionController::ejecutarAccion();
?>