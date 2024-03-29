<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Sucursal.php";

class SucursalController { 
    //Métodos para gestionar peticiones desde la vista 
    public static function ejecutarAccion() {
        $accion  = @$_REQUEST["accion"];

        //Estructura de control 
        switch($accion) {
            case "Guardar": 
                //Método guardar
                SucursalController::guardar();
                break;

            case "Buscar":
                SucursalController::buscar();
                break;

            case "Editar":
                SucursalController::editar();
                break;

            case "Eliminar":
                SucursalController::eliminar();
                break;

            case "todo":
                SucursalController::listar_todo();
                break;

            default:
                header("Location: ../view/error.php?msg=Accion no permitida");
                exit;
        }
    }

    //Logica del método
    public static function guardar() {
        //Datos del form
        $direccion = @$_REQUEST["dir"];
        $codigo_postal = @$_REQUEST["cod"]; 

        $suc = new Sucursal(); 
        $suc->direccion = $direccion;
        $suc->codigo_postal = $codigo_postal;


        //Intentar guarda la sucursal en la bd
        try {
            $suc->save();  #Operación guardar en ld bd
            $total = @Sucursal::count(); #Conteo del total de sucursales
            $msg = "Sucursal guardada, Total: $total";
            header("Location: ../view/sucursales/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit;
        }

        catch(Exception $error) {
            if (strstr($error->getMessage(), "Duplicate")) {
                $msg = "La sucursal ya fue ingresada al sistema";
            }

            else {
                $msg = "Ocurrió un error al guardar la sucursal";
            }

            header("Location: ../view/sucursales/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit; 
        }
    }

    public static function buscar() {
        $id = @$_REQUEST["id"];

        //Intentamos buscar la sucursal en la bd 
        try { 
            $suc = Sucursal::find($id);

            //Colocamos la sucursal en la sesion creada
            $_SESSION["sucursal.find"] = serialize($suc);
            $msg = "Sucursal encontrada"; 

            //Redir a la pagina buscar enviandole un mensaje 
            header("Location: ../view/sucursales/buscar.php?msg=$msg");
            exit;
        }

        catch (Exception $error){
            if (strstr($error->getMessage(), $id)) {
                $msg = "La sucursal no existe";
            }

            else {
                $msg = "Ocurrio un error al guardar la sucursal";
            }

            $_SESSION["sucursal.find"] = NULL; 
            header("Location: ../view/sucursales/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function editar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal guardado en sesion 
        $suc = @$_SESSION["sucursal.find"]; 

        //Convertir a objeto
        $suc = unserialize($suc); 

        if ($suc->id != $id) {
            $msg = "El codigo no corresponde a la sucursal consultada"; 
            header("Location: ../view/sucursales/buscar.php?msg=$msg");
        }

        //Nuevos campos en el formulario
        $codigo_postal = @$_REQUEST["cod"];
        $direccion = @$_REQUEST["dir"]; 

        //Lo colocamos en la sucursal buscada
        $suc->codigo_postal = $codigo_postal; 
        $suc->direccion = $direccion; 

        try { 
            //Guardar la sucursal con los datos actualizados 
            $suc->save(); 

            //Serializamos el sucursal nuevamente y lo guardamos en la sesión 
            $_SESSION["sucursal.find"] = serialize($suc); 
            $msg = "Sucursal editada"; 

            header("Location: ../view/sucursales/buscar.php?msg=$msg");
            exit; 

        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "La sucursal no existe"; 
            }

            else {
                $msg = "Se encontró un error al editar la sucursal";
            }

            $_SESSION["sucursal.find"] = NULL;
            header("Location: ../view/sucursales/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function eliminar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal  guardado en sesion 
        $suc = @$_SESSION["sucursal.find"]; 

        //Convertir a objeto
        $suc = unserialize($suc); 

        if ($suc->id != $id) {
            $msg = "El codigo no corresponde a la sucursal consultada"; 
            header("Location: ../view/sucursales/buscar.php?msg=$msg");
        }

        try {
            $suc->delete(); 
            //Eliminamos la sesion de esta sucursal 
            $suc = @$_SESSION["sucursal.find"] = null; 
            $total = @Sucursal::count(); 
            $msg = "Sucursal eliminada, Total: $total"; 

            header("Location: ../view/sucursales/buscar.php?msg=$msg");
            exit; 
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "La sucursal no existe"; 
            }

            else {
                $msg = "Se encontró un error al eliminar la sucursal";
            }

            $_SESSION["sucursal.find"] = NULL;
            header("Location: ../view/sucursales/buscar.php?msg=$msg");
            exit;
        }

    }
    
    public static function listar_todo() {
        try {
            $sucursales = Sucursal::all();

            if ($sucursales == NULL) {
                $_SESSION["sucursal.all"] = NULL;
                $msg = "Total usuarios: 0"; 
            }
            else {
                $total = count($sucursales);
                $sucursales = serialize($sucursales);
                $_SESSION["sucursal.all"] = $sucursales; 
            }

            $msg = "Total usuarios: $total";
            header("Location: ../view/sucursales/listar_todo.php?msg=$msg");
        }
        catch (Exception $error) {
            $_SESSION["sucursal.all"] = NULL; 
            header("Location: ../view/sucursales/listar_todo.php?msg=Total usuarios: 0");
        }
    }

}

SucursalController::ejecutarAccion();
?>