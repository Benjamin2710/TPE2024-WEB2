"use strict";

// Películas
const selectIdsPeliculas = document.querySelector("#select-ids-peliculas");
const titleFormPeliculas = document.querySelector("#form-title-peliculas");
const formPeliculas = document.querySelector("#form-peliculas");
const contFormPeliculas = document.querySelector("#cont-form-peliculas");
const btnSubmitPeliculas = document.querySelector("#btn-submit-peliculas");

// Géneros
const titleFormGeneros = document.querySelector("#form-title-generos");
const selectIdsGeneros = document.querySelector("#select-ids-generos");
const formGeneros = document.querySelector("#form-generos");
const contFormGeneros = document.querySelector("#cont-form-generos");
const btnSubmitGeneros = document.querySelector("#btn-submit-generos");
const pEliminar = document.querySelector("#p-eliminar-producto");

// Botones de administración
let arrBtnsForm = document.querySelectorAll(".btns-admin");

for (let i = 0; i < arrBtnsForm.length; i++) {
    arrBtnsForm[i].addEventListener('click', () => {
        let action = arrBtnsForm[i].getAttribute('number');
        console.log(`Acción seleccionada: ${action}`); // Para depuración
        cambiarForm(action);
    });
}

function cambiarForm(action) {
    switch (action) {
        case '1':
            formPeliculas.setAttribute('action', 'editarpelicula');
            titleFormPeliculas.innerHTML = 'Editar Pelicula';
            selectIdsPeliculas.className = "form-select__conteiner select-width";
            contFormPeliculas.className = "";
            break;

        case '2':
            formPeliculas.setAttribute('action', 'agregarpelicula');
            titleFormPeliculas.innerHTML = 'Agregar pelicula';
            selectIdsPeliculas.className = "noMostrar";
            contFormPeliculas.className = "";
            break;

        case '3':
            formPeliculas.setAttribute('action', 'eliminarpelicula');
            titleFormPeliculas.innerHTML = 'Eliminar Pelicula';
            selectIdsPeliculas.className = "form-select__conteiner select-width";
            contFormPeliculas.className = "noMostrar";
            break;

        case '4':
            formGeneros.setAttribute('action', 'editargenero');
            titleFormGeneros.innerHTML = 'Editar Genero';
            selectIdsGeneros.className = "form-select__conteiner select-width";
            contFormGeneros.className = "";
            pEliminar.className = "noMostrar";
            break;

        case '5':
            formGeneros.setAttribute('action', 'agregargenero');
            titleFormGeneros.innerHTML = 'Agregar Genero';
            selectIdsGeneros.className = "noMostrar";
            contFormGeneros.className = "";
            pEliminar.className = "noMostrar";
            break;

        case '6':
            formGeneros.setAttribute('action', 'eliminargenero');
            titleFormGeneros.innerHTML = 'Eliminar Genero';
            selectIdsGeneros.className = "form-select__conteiner select-width";
            contFormGeneros.className = "noMostrar";
            pEliminar.className = "";
            break;

        default:
            console.warn(`Acción no válida: ${action}`);
            break;
    }
}
