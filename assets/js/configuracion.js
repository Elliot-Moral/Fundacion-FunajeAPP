function c(dato){
    console.log(dato);
}

const url_h = 'https://www.fundacionamigosdejesus.org/funaje/';
const url = 'http://localhost/funaje/';


const confi_cards = document.querySelectorAll('.about__card');
const tabla = document.getElementById('datos_tabla');

confi_cards.forEach((e, index) => {
    e.addEventListener('click', () => {
        if(index === 0 ){
            abrir_actividades();
        }else if(index === 1 ){
            abrir_modal();
        }else{
            
        }
    });
})


function abrir_modal() {

    const modal = document.getElementById('modal');
    //abrir modal
    modal.classList.add("abrir_modal");
    listar_eventos();

}


// cerrar el modal
function cerrar_modal_agenda() {

    const modal = document.getElementById('modal');
    const bnt_modal = document.getElementById('btn_modal');

    bnt_modal.addEventListener('click', () => {
        modal.classList.remove("abrir_modal");
    })
}

cerrar_modal_agenda();

let eventosFuanje = [];


function listar_eventos() {
    fetch(`${url}agenda/listar_agenda/`)

        .then(respuesta => respuesta.json())
        .then(data => monstrar_datos(data))

        .catch(error => console.log(error))

    const monstrar_datos = (data) => {

        let body = '';

        for (let i = 0; i < data.length; i++) {


            num = i + 1;
            body += `<tr class="tr_columna" id='${num}'>
                            <td>${num}</td>
                            <td>${data[i].tit_agen}</td>
                            <td>${data[i].desc_agen}</td>	          				
                            <td>${data[i].dia_agen}</td>
                            <td>${data[i].mes_agen}</td>
                            <td> <img class="img_tabla" src="${url + data[i].img_agen}"/></td>
                        </tr>`


            // agregar los datos al array para luego manipularlos.
            if (eventosFuanje.length < data.length) {
                eventosFuanje.push({ 'id': data[i].id_agen, 'title': data[i].tit_agen, 'desc': data[i].desc_agen, 'dia': data[i].dia_agen, 'mes': data[i].mes_agen, 'url': data[i].img_agen, })
            }

        }

        tabla.innerHTML = body;

    }
    capturar_el_elemento()
}

let indice_del_evento_selecionado = 0;

function capturar_el_elemento() {
    setTimeout(() => {
        const columnaTabla = tabla.querySelectorAll('.tr_columna');
        columnaTabla.forEach(e => {

            e.addEventListener('click', () => {
                // recorre y quitar todos los estilos
                removerClaseParaTodos(columnaTabla);

                // Asignar el estilo seleiconado
                e.classList.add('tr_columna_selected');

                indice_del_evento_selecionado = e.id - 1;

            })
        })

    }, 500)
}




// Función para manejar el evento de clic en los elementos
function removerClaseParaTodos(columnaTabla) {

    // Eliminar la clase "selected" de todos los elementos
    columnaTabla.forEach(function (elemento) {
        elemento.classList.remove('tr_columna_selected');
    });
}

//traeme los modales
const ventana_modal = document.getElementById('ventana_modal');
const modal_1 = document.getElementById('modal_1');
const modal_2 = document.getElementById('modal_2');
const h2_action_modal = document.getElementById('action_modal');

// traer los botonoes
const bnt_add = document.getElementById('bnt_add');
const bnt_update = document.getElementById('bnt_update');
const bnt_delete = document.getElementById('bnt_delete');

//botones modal 2//
const btn_modal2_cerrar = document.getElementById('btn_modal2_cerrar');
const btn_modal2_guardar = document.getElementById('btn_modal2_guardar');

// inputs valores     
const in_tit = document.getElementById('in_tit');
const in_desc = document.getElementById('in_desc');
const in_dia = document.getElementById('in_dia');
const in_mes = document.getElementById('in_mes');
const in_file = document.getElementById('in_file');
const img = document.getElementById('img_update');
const montrar_imagen = document.getElementById('montrar_imagen');


// agregar los eventos
bnt_add.addEventListener('click', cambiar_ventana_2)

//evento de abrir la ventana agregar.
function cambiar_ventana_2() {
    modal_1.classList.remove('modal_activo');
    modal_2.classList.add('modal_activo');
    ventana_modal.classList.add('ventana2');
    limpiar_campos();
}
function cambiar_ventana_1() {
    modal_2.classList.remove('modal_activo');
    modal_1.classList.add('modal_activo');
    ventana_modal.classList.remove('ventana2');
    limpiar_campos();
    listar_eventos();
}

//captuar el evento de cambio para capturar la imagen a subir
let imagen_evento =  null;
in_file.addEventListener('change', (e) => {
	imagen_evento = e.target.files[0];
	console.log(e.target.files[0]);
});

//agragar evento para guardar datos
btn_modal2_guardar.addEventListener('click', (e) =>{
    e.preventDefault();
    guardar_datos();
})

function validar_campos(tiulo, desc, dia, mes, img){
    if(tiulo !== "" && desc !== "" & dia !== "" & mes !== "" && img != null){
        return true
    }else{
        console.log(`titulo ${tiulo}: desc ${desc}: dia ${dia}: mes ${mes}: img ${img != null}:`)
        return false
    }    
}

function guardar_datos() {

    const data_evento = new FormData();
    const datos_validados = validar_campos(in_tit.value, in_desc.value, in_dia.value, in_mes.value, imagen_evento);

    if(datos_validados){
        data_evento.append('titulo', in_tit.value);
        data_evento.append('desc', in_desc.value);
        data_evento.append('dia', in_dia.value);
        data_evento.append('mes', in_mes.value );
        data_evento.append("img_evento", imagen_evento);  

        fetch(`${url}configuracion/recibir_formulario/`, {
            method: 'POST',
            body: data_evento
        })
            //# obtener respuesta
            .then(respuesta => respuesta.json())
            .then(datos_respuesta => {

                // console.log(datos_respuesta)
                
                // # validar si el back envia 'correcto' o 'error'
                if (datos_respuesta) {
                    limpiar_campos();
                    alert('Datos Guardados Correctamente!');
                    imagen_evento = null;
                    cambiar_ventana_1();

                } else if (datos_respuesta == 'error') {
                    alert('LLenar todo los campos por favor!');
                } else if (datos_respuesta == 'ya_existe') {
                    alert('Ya existe producto con el mismo codigo!!');
                } else {
                    alert('Error en el envio de codigo_producto AJAX!!!');
                }
        })
        .catch(err => console.log(err))

    }else{
        alert('Debes llenar todos los campos y cargar una imagen.')
    }



}



//===== EDITAR EVENTOS
bnt_update.addEventListener('click', () => {

    modal_1.classList.remove('modal_activo');
    modal_2.classList.add('modal_activo');
    ventana_modal.classList.add('ventana2');
    h2_action_modal.textContent = "Editar Evento";

    in_tit.value = eventosFuanje[indice_del_evento_selecionado].title;
    in_desc.value = eventosFuanje[indice_del_evento_selecionado].desc;
    in_dia.value = eventosFuanje[indice_del_evento_selecionado].dia;
    in_mes.value = eventosFuanje[indice_del_evento_selecionado].mes;
    img_update.src = `${url}${eventosFuanje[indice_del_evento_selecionado].url}`;
    montrar_imagen.classList.add("montrar_imagen");

    const id_evento = eventosFuanje[indice_del_evento_selecionado].id;
    enviar_img_evento_servidor(id_evento)


})


//cerra modal 2 // volver al 1
btn_modal2_cerrar.addEventListener('click', () => {
    modal_2.classList.remove('modal_activo');
    modal_1.classList.add('modal_activo');
    ventana_modal.classList.remove('ventana2');
})






// function enviar_img_evento_servidor(id_evento="0"){
// 	const data_imagen = new FormData();
// 	data_imagen.append("img_evento", imagen_evento);
// 	data_imagen.append("id_evento", id_evento);

// 		// fetch('http://localhost/fuanje/configuracion/recibir_imagen', {
// 		// method: 'POST',
// 		// body: data_imagen	
// 		// })
//  		// 	//# obtener respuesta
// 		// 	.then(respuesta => respuesta.json())
// 		// 	.then(datos_respuesta => {

// 		// 		console.log(datos_respuesta);
// 		// 	})
// 		// 	.catch( err => console.log(err))

// }


function eliminar_ventos() {

    const confirmacion = confirm(`Segura quieres eliminar el evento numero ${indice_del_evento_selecionado+1}`)

    if(confirmacion){

        const id = eventosFuanje[indice_del_evento_selecionado].id
        const url_img = eventosFuanje[indice_del_evento_selecionado].url
        const array_url = url_img.split('/');
    
        const data_delete = new FormData();
        data_delete.append('id', id);
        data_delete.append('name_img', array_url[2]);

        console.log(`${id} ${array_url[2]}`)

        fetch(`${url}configuracion/eliminar_evento/`, {
		method: 'POST',
		body: data_delete	
		})
 			//# obtener respuesta
			.then(respuesta => respuesta.json())
			.then(datos_respuesta => {

				console.log(datos_respuesta);
                listar_eventos();

			})
			.catch( err => console.log(err)) 

    }


}

bnt_delete.addEventListener('click', ()=>{
    eliminar_ventos();
});

function limpiar_campos() {
    in_tit.value = ""
    in_desc.value = ""
    in_dia.value = ""
    in_mes.value = ""
    img_update.src = "";
    montrar_imagen.classList.remove("montrar_imagen");
}






// APARTIR DE ACA COMIENZA LA FUNCINALIDAD DE ACTIVIDADES

//abrir modal actividades
function abrir_actividades(){
    const modal = document.getElementById('modal_actidades');
    //abrir modal
    modal.classList.add("abrir_modal");
    listar_actividades();
}

// cerrar el modal
function cerrar_modal_actividades() {

    const modal = document.getElementById('modal_actidades');
    const bnt_modal = document.getElementById('btn_modal_acti');

    bnt_modal.addEventListener('click', () => {
        modal.classList.remove("abrir_modal");
    });
}
cerrar_modal_actividades();

let actividadesFuanje = [];
const tabla_acti = document.getElementById('data_actividades');


function listar_actividades() {
    fetch(`${url}configuracion/listar_actividad/`)

        .then(respuesta => respuesta.json())
        .then(data => monstrar_datos(data))

        .catch(error => console.log(error))

    const monstrar_datos = (data) => {

        let body = '';

        for (let i = 0; i < data.length; i++) {


            num = i + 1;
            body += `<tr class="tr_columna" id='${num}'>
                            <td>${num}</td>
                            <td>${data[i].tit_act}</td>
                            <td>${data[i].desc_act}</td>	          				
                            <td> <img class="img_tabla" src="${url + data[i].img_act}"/></td>
                        </tr>`


            // agregar los datos al array para luego manipularlos.
            if (actividadesFuanje.length < data.length) {
                actividadesFuanje.push({ 'id': data[i].id_act, 'title': data[i].tit_act, 'desc': data[i].desc_act, 'url': data[i].img_act, })
            }

        }

        tabla_acti.innerHTML = body;

    }
    capturar_el_elemento_acti()
}

let indice_del_actividad_selecionado = 0;

function capturar_el_elemento_acti() {
    setTimeout(() => {
        const columnaTabla = tabla_acti.querySelectorAll('.tr_columna');
        columnaTabla.forEach(e => {

            e.addEventListener('click', () => {
                // recorre y quitar todos los estilos
                removerClaseParaTodos(columnaTabla);

                // Asignar el estilo seleiconado
                e.classList.add('tr_columna_selected');

                indice_del_actividad_selecionado = e.id - 1;

            })
        })

    }, 500)
}


//traeme los modales
const ventana_modal_act = document.getElementById('ventana_modal_act');
const modal_1_act = document.getElementById('modal_1_act');
const modal_2_act = document.getElementById('modal_2_act');
const h2_action_modal_act = document.getElementById('action_modal_act');

// traer los botonoes
const bnt_add_act = document.getElementById('bnt_add_acti');
const bnt_update_act = document.getElementById('bnt_update_acti');
const bnt_delete_act = document.getElementById('bnt_delete_acti');

//botones modal 2//
const btn_modal2_cerrar_act = document.getElementById('btn_modal2_cerrar_act');
const btn_modal2_guardar_act = document.getElementById('btn_modal2_guardar_act');
const img_update_act = document.getElementById('img_update_act');
const montrar_imagen_act = document.getElementById('montrar_imagen_act');


// inputs valores     
const form_data_act = document.getElementById('data_form_act');
const input_tit_act = document.getElementById('in_tit_act');
const input_desc_act = document.getElementById('in_desc_act');
const input_file_act = document.getElementById('in_file_act');




// agregar los eventos
bnt_add_act.addEventListener('click', cambiar_ventana_2_act)

//evento de abrir la ventana agregar.
function cambiar_ventana_2_act() {
    modal_1_act.classList.remove('modal_activo');
    modal_2_act.classList.add('modal_activo');
    ventana_modal_act.classList.add('ventana2');
    btn_modal2_guardar_act.value = "Guardar";
    limpiar_campos_act();
}
function cambiar_ventana_1_act() {

    modal_2_act.classList.remove('modal_activo');
    modal_1_act.classList.add('modal_activo');
    ventana_modal_act.classList.remove('ventana2');
    listar_actividades();
}

//captuar el evento de cambio para capturar la imagen a subir
let imagen_actividad =  null;
input_file_act.addEventListener('change', (e) => {
	imagen_actividad = e.target.files[0];
	console.log(e.target.files[0]);
});

//id name_img
let datos_para_actualizar = [];

//agragar evento para guardar datos
btn_modal2_guardar_act.addEventListener('click', (e) =>{
    e.preventDefault();

    if(btn_modal2_guardar_act.value === "Actulizar"){
        actualizar_actividades(datos_para_actualizar[0],datos_para_actualizar[1]);
    }else{
        guardar_datos_act();
    }
})

//cerra modal 2 // volver al 1
btn_modal2_cerrar_act.addEventListener('click', (e) => {
    e.preventDefault();
    modal_2_act.classList.remove('modal_activo');
    modal_1_act.classList.add('modal_activo');
    ventana_modal_act.classList.remove('ventana2');
})


function guardar_datos_act() {

    const data_evento = new FormData(form_data_act);
    const datos_validados = validar_campos(input_tit_act.value, input_desc_act.value, true, true, imagen_actividad);

    if(datos_validados){

        fetch(`${url}configuracion/guardar_actividades/`, {
            method: 'POST',
            body: data_evento
        })
            //# obtener respuesta
            .then(respuesta => respuesta.json())
            .then(datos_respuesta => {

                console.log(datos_respuesta)
                
                // # validar si el back envia 'correcto' o 'error'
                if (datos_respuesta == 'correcto') {
                    alert('Datos Guardados Correctamente!');
                    limpiar_campos_act();
                    imagen_actividad = null;
                    cambiar_ventana_1_act();

                } else if (datos_respuesta == 'error') {
                    alert('LLenar todo los campos por favor!');
                } else if (datos_respuesta == 'ya_existe') {
                    alert('Ya existe producto con el mismo codigo!!');
                } else {
                    alert('Error en el envio de codigo_producto AJAX!!!');
                }
        })
        .catch(err => console.log(err))

    }else{
        alert('Debes llenar todos los campos y cargar una imagen.')
    }
}



function limpiar_campos_act(){
    input_tit_act.value = '';
    input_desc_act.value = '';
}




//===== EDITAR EVENTOS
bnt_update_act.addEventListener('click', () => {

    modal_1_act.classList.remove('modal_activo');
    modal_2_act.classList.add('modal_activo');
    ventana_modal_act.classList.add('ventana2');
    h2_action_modal_act.textContent = "Editar Actividad";
    btn_modal2_guardar_act.value = "Actulizar";

    input_tit_act.value = actividadesFuanje[indice_del_actividad_selecionado].title;
    input_desc_act.value = actividadesFuanje[indice_del_actividad_selecionado].desc;
    img_update_act.src = `${url}${actividadesFuanje[indice_del_actividad_selecionado].url}`;
    montrar_imagen_act.classList.add("montrar_imagen");

    const id_actividad = actividadesFuanje[indice_del_actividad_selecionado].id;
    const url_img = actividadesFuanje[indice_del_actividad_selecionado].url
    const array_url = url_img.split('/');
    console.log(`${id_actividad} ${array_url[2]}`);

    datos_para_actualizar[0] = id_actividad;
    datos_para_actualizar[1] = array_url[2];

    console.log(datos_para_actualizar);

})


function actualizar_actividades(id,name_img){

    data_actividad = new FormData()
    let datos_validados = false;


    if(imagen_actividad === null){

        datos_validados = validar_campos(input_tit_act.value, input_desc_act.value, true, true, true);
        
        data_actividad.append('id', id);
        data_actividad.append('titulo', input_tit_act.value);
        data_actividad.append('desc', input_desc_act.value);

        if(datos_validados){
            enviar_datos_sin_img(data_actividad)
        }else{
            alert('No debes dejar campos vacios.');
        }

    }else{

        datos_validados = validar_campos(input_tit_act.value, input_desc_act.value, true, true, imagen_actividad);
        
        data_actividad.append('id', id);
        data_actividad.append('titulo', input_tit_act.value);
        data_actividad.append('desc', input_desc_act.value);
        data_actividad.append('img_act', name_img);
        data_actividad.append("file_act", imagen_actividad);

        if(datos_validados){
            enviar_datos_con_img(data_actividad) 
        }else{
            alert('No debes dejar campos vacios.');
        }


    }
    

    
}
function enviar_datos_sin_img(data_actividad){

            fetch(`${url}configuracion/actualizar_actividades_sin_img/`, {
                method: 'POST',
                body: data_actividad
            })
                //# obtener respuesta
                .then(respuesta => respuesta.json())
                .then(datos_respuesta => {
    
                    console.log(datos_respuesta)
                    
                    // # validar si el back envia 'correcto' o 'error'
                    if (datos_respuesta == 'correcto') {
                        alert('Datos Actualizados Correctamente!');
                        limpiar_campos_act();
                        imagen_actividad = null;
                        datos_para_actualizar[0] = null;    
                        datos_para_actualizar[1] = null;
                        cambiar_ventana_1_act();
                    }
            })
            .catch(err => console.log(err))
}

function enviar_datos_con_img(data_actividad){
    fetch(`${url}configuracion/actualizar_actividades_con_img/`, {
        method: 'POST',
        body: data_actividad
    })
        //# obtener respuesta
        .then(respuesta => respuesta.json())
        .then(datos_respuesta => {

            console.log(datos_respuesta)
            
            // # validar si el back envia 'correcto' o 'error'
            if (datos_respuesta == 'correcto') {
                alert('Datos Actualizados Correctamente!');
                limpiar_campos_act();
                imagen_actividad = null;
                cambiar_ventana_1_act();
                datos_para_actualizar[0] = null;    
                datos_para_actualizar[1] = null;
            }
            
    })
    .catch(err => console.log(err))
}



//===== EDITAR ELIMINAR

bnt_delete_act.addEventListener('click', eliminar_actividad );
function eliminar_actividad() {

    let confirmacion = confirm(`Segura quieres eliminar el evento numero ${indice_del_actividad_selecionado+1}`)

    const id = actividadesFuanje[indice_del_actividad_selecionado].id
    const url_img = actividadesFuanje[indice_del_actividad_selecionado].url
    const array_url = url_img.split('/');
    console.log(`${id} ${array_url[2]}`)


    if(confirmacion){

    
        const data_delete = new FormData();
        data_delete.append('id', id);
        data_delete.append('name_img', array_url[2]);


        fetch(`${url}configuracion/eliminar_actividad/`, {
		method: 'POST',
		body: data_delete	
		})
 			//# obtener respuesta
			.then(respuesta => respuesta.json())
			.then(datos_respuesta => {

				console.log(datos_respuesta);
                listar_actividades();

			})
			.catch( err => console.log(err)) 

    }

}