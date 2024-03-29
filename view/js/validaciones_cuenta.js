//Función para gestionar los botones editar y eliminar. 

function habilitarBotones() {

    //Botones 

    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");

    //Campos
    const campoCodigo = document.getElementById("id");
    const campoTipoCuenta = document.getElementById("tipo");
    const campoSaldoActual = document.getElementById("actual");
    const campoSaldoMedio = document.getElementById("medio");
    const campoNumeroCuenta = document.getElementById("numero_cuenta");
    const campoFechaApertura = document.getElementById("fecha_apertura");
    const campoCodigoSucursal = document.getElementById("sucursal_id");
    const campoCodigoCliente = document.getElementById("cliente_id");

    //Se activa cuando escriben en el campo
    campoTipoCuenta.addEventListener("input", () => { 
        if (campoTipoCuenta.value === "") {
            botonEditar.disabled = true; 
            botonEliminar.disable = true;
        } else {
            botonEditar.disabled = false; 
        }
    })


    //Solo lectura si el campo está vacío 
    if (campoTipoCuenta.value == "") {
        botonEditar.disabled = true; 
        botonEliminar.disabled = true; 
        campoTipoCuenta.setAttribute("readonly", true); 
        campoSaldoActual.setAttribute("readonly", true); 
        campoSaldoMedio.setAttribute("readonly", true); 
        campoNumeroCuenta.setAttribute("readonly", true); 
        campoFechaApertura.setAttribute("readonly", true); 
        campoCodigoSucursal.setAttribute("readonly", true); 
        campoCodigoCliente.setAttribute("readonly", true);
    }

    else {
        botonEditar.disabled = false; 
        botonEliminar.disabled = false; 

        campoTipoCuenta.removeAttribute("readonly"); 
        campoSaldoActual.removeAttribute("readonly"); 
        campoSaldoMedio.removeAttribute("readonly"); 
        campoNumeroCuenta.removeAttribute("readonly"); 
        campoFechaApertura.removeAttribute("readonly"); 
        campoCodigoSucursal.removeAttribute("readonly"); 
        campoCodigoCliente.removeAttribute("readonly");
    }


}

function confirmarOperacion() {
    //Botones 
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");

    botonEditar.addEventListener("click", (event) => {
        mensaje = "¿Desea modificar los datos de esta cuenta?";
        return confirmar(mensaje, event);
    }); 

    botonEliminar.addEventListener("click", (event) => {
        mensaje = "Desea eliminar esta cuenta?";
        confirmar(mensaje, event); 
    })
}

function confirmar(mensaje, event) {

    //Mostrar una alerta de confirmación (SI/NO)
    const answer = confirm(mensaje); 

    //Si seleccionamos no, se cancela el envío del form 
    if (!answer) {
        event.preventDefault(); 
    }
}