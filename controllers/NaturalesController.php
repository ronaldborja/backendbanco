<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/ClienteNatural.php";

class ClienteNaturalController { 
    //Métodos para gestionar peticiones desde la vista 
    public static function ejecutarAccion() {
        $accion  = @$_REQUEST["accion"];

        //Estructura de control 
        switch($accion) {
            case "Guardar": 
                //Método guardar
                ClienteNaturalController::guardar();
                break;

            case "Buscar":
                ClienteNaturalController::buscar();
                break;

            case "Editar":
                ClienteNaturalController::editar();
                break;

            case "Eliminar":
                ClienteNaturalController::eliminar();
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
        $fecha_nacimiento = @$_REQUEST["fn"];
        $sexo = @$_REQUEST["sex"]; 
        $nombre = @$_REQUEST["nombre"];
        $direccion = @$_REQUEST["dir"];

        $cn = new ClienteNatural(); 
        $cn->id = $id;
        $cn->fecha_nacimiento = $fecha_nacimiento;
        $cn->sexo = $sexo;
        $cn->nombre = $nombre;
        $cn->direccion = $direccion; 


        //Intentar guarda la sucursal en la bd
        try {
            $cn->save();  #Operación guardar en ld bd
            $total = @ClienteNatural::count(); #Conteo del total de sucursales
            $msg = "Cliente guardado, Total: $total";
            header("Location: ../view/naturales/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit;
        }

        catch(Exception $error) {
            if (strstr($error->getMessage(), "Duplicate")) {
                $msg = "El cliente ya fue ingresada al sistema";
            }

            else {
                $msg = "Ocurrió un error al guardar el cliente";
            }

            header("Location: ../view/naturales/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit; 
        }
    }

    public static function buscar() {
        $id = @$_REQUEST["id"];

        //Intentamos buscar la sucursal en la bd 
        try { 
            $cn = ClienteNatural::find($id);

            //Colocamos la sucursal en la sesion creada
            $_SESSION["natural.find"] = serialize($cn);
            $msg = "Cliente encontrado"; 

            //Redir a la pagina buscar enviandole un mensaje 
            header("Location: ../view/naturales/buscar.php?msg=$msg");
            exit;
        }

        catch (Exception $error){
            if (strstr($error->getMessage(), $id)) {
                $msg = "El cliente no existe";
            }

            else {
                $msg = "Ocurrio un error al guardar el cliente";
            }

            $_SESSION["natural.find"] = NULL; 
            header("Location: ../view/naturales/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function editar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal guardado en sesion 
        $cn = @$_SESSION["natural.find"]; 

        //Convertir a objeto
        $cn = unserialize($cn); 

        if ($cn->id != $id) {
            $msg = "El Cliente no corresponde a la sucursal consultada"; 
            header("Location: ../view/naturales/buscar.php?msg=$msg");
        }

        //Nuevos campos en el formulario
        $fecha_nacimiento = @$_REQUEST["fn"];
        $sexo = @$_REQUEST["sex"]; 
        $nombre = @$_REQUEST["nombre"];
        $direccion = @$_REQUEST["direccion"];

        //Lo colocamos en la sucursal buscada
        $cn->fecha_nacimiento = $fecha_nacimiento;
        $cn->sexo = $sexo;
        $cn->nombre = $nombre;
        $cn->direccion = $direccion;  

        try { 
            //Guardar la sucursal con los datos actualizados 
            $cn->save(); 

            //Serializamos el sucursal nuevamente y lo guardamos en la sesión 
            $_SESSION["natural.find"] = serialize($cn); 
            $msg = "Cliente editado"; 

            header("Location: ../view/naturales/buscar.php?msg=$msg");
            exit; 

        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "El cliente no existe"; 
            }

            else {
                $msg = "Se encontró un error al editar el cliente";
            }

            $_SESSION["natural.find"] = NULL;
            header("Location: ../view/naturales/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function eliminar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal  guardado en sesion 
        $cn = @$_SESSION["natural.find"]; 

        //Convertir a objeto
        $cn = unserialize($cn); 

        if ($cn->id != $id) {
            $msg = "El codigo no corresponde al cliente consultado"; 
            header("Location: ../view/naturales/buscar.php?msg=$msg");
        }

        try {
            $cn->delete(); 
            //Eliminamos la sesion de esta sucursal 
            $cn = @$_SESSION["natural.find"] = null; 
            $total = @ClienteNatural::count(); 
            $msg = "Cliente eliminado, Total: $total"; 

            header("Location: ../view/Naturales/buscar.php?msg=$msg");
            exit; 
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "El cliente no existe"; 
            }

            else {
                $msg = "Se encontró un error al eliminar el cliente";
            }

            $_SESSION["natural.find"] = NULL;
            header("Location: ../view/naturales/buscar.php?msg=$msg");
            exit;
        }

    }

}

ClienteNaturalController::ejecutarAccion();
?>