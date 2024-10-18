"use strict"
let arrGenerosPeliculas = document.querySelectorAll('.generos-peliculas');
let arrCards = document.querySelectorAll('.card');

for(let i = 0; i < arrGenerosPeliculas.length; i++){
    arrGenerosPeliculas[i].addEventListener('click', (function(index) {
        return function() {
            let idGenero = arrGenerosPeliculas[index].getAttribute("id");
            organizarXGenero(idGenero);
        };
    })(i)); // Cierre para capturar el valor de i
}

function organizarXGenero(id){
    removeNoMostrar();
    if(id != 0){
        for(let i = 0; i < arrCards.length; i++){
            let generoNum = arrCards[i].getAttribute('categoryID'); // Cambié aquí
            if(generoNum != id){
                arrCards[i].classList.add('noMostrar');
            }
        }
    }
}

function removeNoMostrar(){
    for(let i = 0; i < arrCards.length; i++){
        arrCards[i].classList.remove('noMostrar');
    }
}
