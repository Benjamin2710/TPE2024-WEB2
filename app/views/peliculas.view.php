<?php

class PeliculasView {
    public function showPeliculas($peliculas) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($peliculas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        // require 'templates/lista_tareas.phtml';
        require 'templates/listaPeliculas.phtml';
    }

   // public function showError($error) {
   //     require 'templates/error.phtml';
   // }

}