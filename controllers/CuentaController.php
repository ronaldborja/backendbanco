<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."backendbanco/models/entities/Cuenta.php";

class CuentaController { 
    //Métodos para gestionar peticiones desde la vista 
    public static function ejecutarAccion() {
        $accion  = @$_REQUEST["accion"];

        //Estructura de control 
        switch($accion) {
            case "Guardar": 
                //Método guardar
                CuentaController::guardar();
                break;

            case "Buscar":
                CuentaController::buscar();
                break;

            case "Editar":
                CuentaController::editar();
                break;

            case "Eliminar":
                CuentaController::eliminar();
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
        $codigo_cuenta = @$_REQUEST["id"];
        $tipo_cuenta = @$_REQUEST["tipo"];
        $saldo_actual = @$_REQUEST["actual"];
        $saldo_medio = @$_REQUEST["medio"];
        $numero_cuenta = @$_REQUEST["numero_cuenta"];
        $fecha_apertura = @$_REQUEST["fecha_apertura"];
        $sucursal = @$_REQUEST["sucursal_id"];
        $cliente = @$_REQUEST["cliente_id"];
        $banco_id = 1; 

        $cuenta = new Cuenta(); 
        $cuenta->id = $codigo_cuenta;
        $cuenta->tipo_cuenta = $tipo_cuenta;
        $cuenta->saldo_actual = $saldo_actual;
        $cuenta->saldo_medio = $saldo_medio;
        $cuenta->numero_cuenta = $numero_cuenta;
        $cuenta->fecha_apertura = $fecha_apertura;
        $cuenta->sucursal_id = $sucursal; 
        $cuenta->cliente_id = $cliente; 
        $cuenta->banco_id = $banco_id;

        //Intentar guarda la sucursal en la bd
        try {
            $cuenta->save();  #Operación guardar en ld bd
            $total = @Cuenta::count(); #Conteo del total de sucursales
            $msg = "Cuenta guardada, Total: $total";
            header("Location: ../view/cuentas/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit;
        }

        catch(Exception $error) {
            if (strstr($error->getMessage(), "Duplicate")) {
                $msg = "La cuenta ya fue ingresada al sistema";
            }

            else {
                $msg = "Ocurrió un error al guardar la cuenta";
            }

            header("Location: ../view/cuentas/agregar.php?msg=$msg"); #Al finalizar la operación, se redirecciona a la pag guardar
            exit; 
        }
    }

    public static function buscar() {
        $id = @$_REQUEST["id"];

        //Intentamos buscar la sucursal en la bd 
        try { 
            $c = Cuenta::find($id);

            //Colocamos la sucursal en la sesion creada
            $_SESSION["cuenta.find"] = serialize($c);
            $msg = "Cuenta encontrada"; 

            //Redir a la pagina buscar enviandole un mensaje 
            header("Location: ../view/cuentas/buscar.php?msg=$msg");
            exit;
        }

        catch (Exception $error){
            if (strstr($error->getMessage(), $id)) {
                $msg = "La cuenta no existe";
            }

            else {
                $msg = "Ocurrio un error al encontrar la cuenta";
            }

            $_SESSION["cuenta.find"] = NULL; 
            header("Location: ../view/cuentas/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function editar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal guardado en sesion 
        $c = @$_SESSION["cuenta.find"]; 

        //Convertir a objeto
        $c = unserialize($c); 

        if ($c->id != $id) {
            $msg = "El id no corresponde a la cuenta consultado"; 
            header("Location: ../view/cuentas/buscar.php?msg=$msg");
        }

        //Nuevos campos en el formulario
        $tipo_cuenta = @$_REQUEST["tipo"];
        $saldo_actual = @$_REQUEST["actual"];
        $saldo_medio = @$_REQUEST["medio"];
        $numero_cuenta = @$_REQUEST["numero_cuenta"];
        $fecha_apertura = @$_REQUEST["fecha_apertura"];
        $sucursal = @$_REQUEST["sucursal_id"];
        $cliente = @$_REQUEST["cliente_id"];
        $banco_id = 1; 


        //Lo colocamos en la sucursal buscada
        $c->tipo_cuenta = $tipo_cuenta;
        $c->saldo_actual = $saldo_actual;
        $c->saldo_medio = $saldo_medio;
        $c->numero_cuenta = $numero_cuenta;
        $c->fecha_apertura = $fecha_apertura;
        $c->sucursal_id = $sucursal; 
        $c->cliente_id = $cliente; 
        $c->banco_id = $banco_id;

        try { 
            //Guardar la sucursal con los datos actualizados 
            $c->save(); 

            //Serializamos el sucursal nuevamente y lo guardamos en la sesión 
            $_SESSION["cuenta.find"] = serialize($c); 
            $msg = "Cuenta editada"; 

            header("Location: ../view/cuentas/buscar.php?msg=$msg");
            exit; 

        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "La cuenta no existe"; 
            }

            else {
                $msg = "Se encontró un error al editar la cuenta";
            }

            $_SESSION["cuenta.find"] = NULL;
            header("Location: ../view/cuentas/buscar.php?msg=$msg");
            exit;
        }
    }

    public static function eliminar() {
        //Primero se busca la sucursal
        $id = @$_REQUEST["id"];

        //Obtener la sucursal  guardado en sesion 
        $c = @$_SESSION["cuenta.find"]; 

        //Convertir a objeto
        $c = unserialize($c); 

        if ($c->id != $id) {
            $msg = "El codigo no corresponde a la cuenta consultado"; 
            header("Location: ../view/cuentas/buscar.php?msg=$msg");
        }

        try {
            $c->delete(); 
            //Eliminamos la sesion de esta sucursal 
            $c = @$_SESSION["cuenta.find"] = null; 
            $total = @Cuenta::count(); 
            $msg = "Cuenta eliminada, Total: $total"; 

            header("Location: ../view/cuentas/buscar.php?msg=$msg");
            exit; 
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $id)) {
                $msg = "La cuenta no existe"; 
            }

            else {
                $msg = "Se encontró un error al eliminar la cuenta";
            }

            $_SESSION["cuenta.find"] = NULL;
            header("Location: ../view/cuentas/buscar.php?msg=$msg");
            exit;
        }

    }

}

CuentaController::ejecutarAccion();
?>