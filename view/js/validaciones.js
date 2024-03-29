//Función para gestionar los botones editar y eliminar. 

function habilitarBotones() {

    //Botones 
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");

    //Campos
    const campoCodigoPostal =  document.getElementById("cod");
    const campoDireccion = document.getElementById("dir");

    //Se activa cuando escriben en el campo
    campoCodigoPostal.addEventListener("input", () => { 
        if (campoCodigoPostal.value === "") {
            botonEditar.disabled = true; 
            botonEliminar.disable = true;
        } else {
            botonEditar.disabled = false; 
        }
    })


    //Solo lectura si el campo está vacío 
    if (campoCodigoPostal.value == "") {
        botonEditar.disabled = true; 
        botonEliminar.disabled = true; 
        campoCodigoPostal.setAttribute("readonly", true);
        campoDireccion.setAttribute("readonly", true); 
    }

    else {
        botonEditar.disabled = false; 
        botonEliminar.disabled = false; 
        campoCodigoPostal.removeAttribute("readonly");
        campoDireccion.removeAttribute("readonly");
    }


}

function confirmarOperacion() {
    //Botones 
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");

    botonEditar.addEventListener("click", (event) => {
        mensaje = "¿Desea modificar los datos de esta sucursal?";
        return confirmar(mensaje, event);
    }); 

    botonEliminar.addEventListener("click", (event) => {
        mensaje = "Desea eliminar la sucursal?";
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