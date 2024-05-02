const formulario = document.getElementById("form_contact");
const bnt_enviar = document.getElementById("btn_send");

const url_h = 'https://www.fundacionamigosdejesus.org/funaje/';
const url = 'http://localhost/funaje/';

const nombre = document.getElementById("in_nombre");
const correo = document.getElementById("in_correo");
const celular = document.getElementById("in_celular");
const pais = document.getElementById("in_pais");
const mensaje = document.getElementById("in_mensaje");

console.log(nombre)

function validarCampos(nombre, correo, celular, pais, mensaje){
    if(nombre !== "" && correo !== "" && celular !== "" && pais !== "" && mensaje !== ""){
        return true;
    }else{
        return false;
    }
}


bnt_enviar.addEventListener('click', ()=>{
    const data_form = new FormData(formulario);
    const resul  = validarCampos(nombre.value, correo.value, celular.value, pais.value, mensaje.value);

    if(resul){
        fetch(`${url}contacto/recibir_formulario/`, {
            method: 'POST',
            body: data_form
        })
            //# obtener respuesta
            .then(respuesta => respuesta.json())
            .then(datos_respuesta => {
    
                console.log(datos_respuesta)
                
                // # validar si el back envia 'correcto' o 'error'
                // if (datos_respuesta) {
                //     // limpiar_campos();
                //     // alert('Datos Guardados Correctamente!');
                //     // imagen_evento = null;
                //     // cambiar_ventana_1();
    
                // } else if (datos_respuesta == 'error') {
                //     alert('LLenar todo los campos por favor!');
                // } else if (datos_respuesta == 'ya_existe') {
                //     alert('Ya existe producto con el mismo codigo!!');
                // } else {
                //     alert('Error en el envio de codigo_producto AJAX!!!');
                // }
        })
        .catch(err => console.log(err))
    }else{
        alert('debes llenar todos los campos');
    }

    
})