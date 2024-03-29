//Función para gestionar los botones editar y eliminar. 

function habilitarBotones() {

    //Botones 

    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");

    //Campos
    const campoCodigo = document.getElementById("id");
    const campoNombre =  document.getElementById("nombre");
    const campoDireccion = document.getElementById("dir");
    const campoFechaNacimiento = document.getElementById("fn");
    const campoSexo = document.getElementById("sex");

    //Se activa cuando escriben en el campo
    campoNombre.addEventListener("input", () => { 
        if (campoNombre.value === "") {
            botonEditar.disabled = true; 
            botonEliminar.disable = true;
        } else {
            botonEditar.disabled = false; 
        }
    })


    //Solo lectura si el campo está vacío 
    if (campoNombre.value == "") {
        botonEditar.disabled = true; 
        botonEliminar.disabled = true; 
        campoNombre.setAttribute("readonly", true); 
        campoDireccion.setAttribute("readonly", true); 
        campoFechaNacimiento.setAttribute("readonly", true); 
        campoSexo.setAttribute("readonly", true); 
    }

    else {
        botonEditar.disabled = false; 
        botonEliminar.disabled = false; 

        campoNombre.removeAttribute("readonly"); 
        campoDireccion.removeAttribute("readonly"); 
        campoFechaNacimiento.removeAttribute("readonly"); 
        campoSexo.removeAttribute("readonly"); 
    }


}

function confirmarOperacion() {
    //Botones 
    const botonEditar = document.getElementById("editar");
    const botonEliminar = document.getElementById("eliminar");

    botonEditar.addEventListener("click", (event) => {
        mensaje = "¿Desea modificar los datos de este cliente?";
        return confirmar(mensaje, event);
    }); 

    botonEliminar.addEventListener("click", (event) => {
        mensaje = "Desea eliminar el cliente?";
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