<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cliente.php";

class ClienteController { 
    //Métodos para gestionar peticiones desde la vista 
    public static function ejecutarAccion() {
        $accion  = @$_REQUEST["accion"];

        //Estructura de control 
        switch($accion) {
            case "Guardar": 
                //Método guardar
                ClienteController::guardar();
                break;

            case "Buscar":
                ClienteController::buscar();
                break;

            case "Editar":
                ClienteController::editar();
                break;

            case "Eliminar":
                ClienteController::eliminar();
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
        $nombre = @$_REQUEST["nombre"];
        $cliente_natural_id = @$_REQUEST["nat"];
        $organizacion_id = @$_REQUEST["org"];

        $c = new Cliente(); 
        $c->id = $id; 
        $c->nombre = $nombre;
        $c->cliente_natural_id = !empty($cliente_natural_id) ? $cliente_natural_id : null;
        $c->organizacion_id = !empty($organizacion_id) ? $organizacion_id : null;


        //Intentar guarda la sucursal en la bd
        try {
            $c->save();  #Operación guardar en ld bd
            $total = @Cliente::count(); #Conteo del total de sucursales
            $msg = "Cliente guardado, Total: $total";
            header("Location: ../view/clientes/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit;
        }

        catch(Exception $error) {
            if (strstr($error->getMessage(), "Duplicate")) {
                $msg = "El cliente ya fue ingresada al sistema";
            }

            else {
                $msg = "Ocurrió un error al guardar el cliente";
            }

            header("Location: ../view/clientes/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit; 
        }
    }

    public static function buscar() {
        $id = @$_REQUEST["id"];

        //Intentamos buscar la sucursal en la bd 
        try { 
            $c = Cliente::find($id);

            //Colocamos la sucursal en la sesion creada
            $_SESSION["cliente.find"] = serialize($c);
            $msg = "Cliente encontrado"; 

            //Redir a la pagina buscar enviandole un mensaje 
            header("Location: ../view/clientes/buscar.php?msg=$msg");
            exit;
        }

        catch (Exception $error){
            if (strstr($error->getMessage(), $id)) {
                $msg = "El cliente no existe";
            }

            else {
                $msg = "Ocurrio un error al buscar el cliente";
            }

            $_SESSION["cliente.find"] = NULL; 
            header("Location: ../view/clientes/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function editar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal guardado en sesion 
        $c = @$_SESSION["cliente.find"]; 

        //Convertir a objeto
        $c = unserialize($c); 

        if ($c->id != $id) {
            $msg = "El codigo no corresponde al cliente consultada"; 
            header("Location: ../view/clientes/buscar.php?msg=$msg");
        }

        //Nuevos campos en el formulari
        $cliente_natural_id = @$_REQUEST["nat"]; 
        $organizacion_id = @$_REQUEST["org"]; 
        $nombre = @$_REQUEST["nombre"];

        //Lo colocamos en la sucursal buscada
        $c->cliente_natural_id = !empty($cliente_natural_id) ? $cliente_natural_id : null;
        $c->organizacion_id = !empty($organizacion_id) ? $organizacion_id : null;
        $c->nombre = $nombre;  

        try { 
            //Guardar la sucursal con los datos actualizados 
            $c->save(); 

            //Serializamos el sucursal nuevamente y lo guardamos en la sesión 
            $_SESSION["cliente.find"] = serialize($c); 
            $msg = "Cliente editado"; 

            header("Location: ../view/clientes/buscar.php?msg=$msg");
            exit; 

        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "El cliente no existe"; 
            }

            else {
                $msg = "Se encontró un error al editar el cliente";
            }

            $_SESSION["cliente.find"] = NULL;
            header("Location: ../view/clientes/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function eliminar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal  guardado en sesion 
        $c = @$_SESSION["cliente.find"]; 

        //Convertir a objeto
        $c = unserialize($c); 

        if ($c->id != $id) {
            $msg = "El codigo no corresponde al cliente consultado"; 
            header("Location: ../view/clientes/buscar.php?msg=$msg");
        }

        try {
            $c->delete(); 
            //Eliminamos la sesion de esta sucursal 
            $c = @$_SESSION["cliente.find"] = null; 
            $total = @Cliente::count(); 
            $msg = "Cliente eliminado, Total: $total"; 

            header("Location: ../view/clientes/buscar.php?msg=$msg");
            exit; 
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "El cliente no existe"; 
            }

            else {
                $msg = "Se encontró un error al eliminar el cliente";
            }

            $_SESSION["cliente.find"] = NULL;
            header("Location: ../view/clientes/buscar.php?msg=$msg");
            exit;
        }

    }

}

ClienteController::ejecutarAccion();
?>