

const url_h = 'https://www.fundacionamigosdejesus.org/funaje/';
const url = 'http://localhost/funaje/';


const data_actividades_cards = document.getElementById('data_actividades_cards');

function listar_actividades() {
    fetch(`${url}configuracion/listar_actividad/`)

        .then(respuesta => respuesta.json())
        .then(data => monstrar_datos(data))

        .catch(error => console.log(error))

    const monstrar_datos = (data) => {

        console.log(data);

        let body = '';

        for (let i = 0; i < data.length; i++) {

            num = i + 1;
            body += `<div class="actividades__card" id='${num}'>
                            <div>
                                <img src="${url + data[i].img_act}" alt="Imagen de la actividad de mes" class="actividades__img">
                            </div>
                            <h3 class="actividades__subtitle">${data[i].tit_act}</h3>
                            <p class="actividades__text" >${data[i].desc_act}</p>        				
                        </div>`
        }

        data_actividades_cards.innerHTML = body;

    }
}

listar_actividades();