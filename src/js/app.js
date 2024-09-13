document.addEventListener('DOMContentLoaded', ()=>{
    eventListeners();
    const body = document.querySelector('body');
    if(localStorage.getItem('dark-mode') === 'true'){
        body.classList.add('dark-mode');
    }
    const alerta = document.querySelector('.exito');
    if(alerta){
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
});
function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navResponsiva);

    const dark = document.querySelector('.icono-dark');
    dark.addEventListener('click', darkMode); 
    
    const metodoContactos = document.querySelectorAll('input[name="contacto[contacto]"');
    metodoContactos.forEach(input => input.addEventListener('click', mostrarEvento));

    const nombreInput = document.querySelector('#nombre');
    const mensajeInput = document.querySelector('#mensaje');
    const precioInput = document.querySelector('#precio');

    if(nombreInput && mensajeInput && precioInput){
        nombreInput.addEventListener('blur', validacionInput);
        mensajeInput.addEventListener('blur', validacionInput);
        precioInput.addEventListener('blur', validacionInput);
    }

}
function navResponsiva(){
    const nav = document.querySelector('.navegacion');
    if(nav.classList.contains('mostrar')){
        nav.classList.remove('mostrar');
    }else{
        nav.classList.add('mostrar');
    }
}
function darkMode(e){
    e.preventDefault();
    const body = document.querySelector('body');

    let dark = false;

    if(body.classList.contains('dark-mode')){
        body.classList.remove('dark-mode');
        dark = false;
    }else{
        body.classList.add('dark-mode');
        dark = true;
    }
    localStorage.setItem('dark-mode', dark);
}

function mostrarEvento(e){
    const divContacto = document.querySelector('#contacto');
    if(e.target.value === "telefono"){
        divContacto.innerHTML = `
            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]" required>

            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" required>
        `;
    }else{
        divContacto.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }
}
const contacto = {
    nombre: "",
    mensaje: "",
    precio: ""
}
const btnEnviar = document.querySelector('#enviar');

function validacionInput(e){
    const valor = e.target.value;
    const nombreCampo = e.target.name.split("[")[1].split("]")[0]
    const campo = e.target;

    if(valor.trim() === ''){
        const mensaje = `El campo ${nombreCampo} es obligatorio`;
        const tipo = "error";
        contacto[nombreCampo] = "";
        habilitarBotonEnviar(contacto);
        mostrarAlerta(mensaje, tipo, campo);
        return;
    }
    eliminarAlerta(campo.parentElement);
    contacto[nombreCampo] = valor.trim().toLowerCase();
    habilitarBotonEnviar(contacto);
    console.log(contacto);
}
function mostrarAlerta(mensaje, tipo, campo){
    eliminarAlerta(campo.parentElement);
    const divAlerta = document.createElement('DIV');

    if(tipo === "error"){
        divAlerta.classList.add('alerta', 'error', 'alerta');
    }
    divAlerta.textContent = mensaje;
    campo.parentElement.appendChild(divAlerta);

}
function eliminarAlerta(campo){
    const alerta = campo.querySelector('.alerta');
    if(alerta){
        alerta.remove();
    }
}
function habilitarBotonEnviar(contacto){
    if(Object.values(contacto).includes('')){
        btnEnviar.classList.add('btn-verde-deshabilitado');
        btnEnviar.classList.remove('btn-verde');
        btnEnviar.disabled = true;
    }else{
        btnEnviar.classList.remove('btn-verde-deshabilitado');
        btnEnviar.classList.add('btn-verde');
        btnEnviar.disabled = false;
    }
}

































