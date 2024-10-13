<?php

class PeliculasView {
    public function showPeliculas($peliculas) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($peliculas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        // require 'templates/lista_tareas.phtml';
        require 'templates/listaPeliculas.phtml';
        echo "<pre>";
        var_dump($peliculas);
        echo "</pre>";

        echo "<br>";

        echo "<pre>";
        var_dump($count);
        echo "</pre>";
    }

    public function showPelicula($pelicula) {
        require 'templates/item.phtml';
        echo "<pre>";
        var_dump($pelicula);
        echo "</pre>";
    }

    public function showFormAltaPelicula($generos) {
        require 'templates/formAltaPelicula.phtml';
        echo "<pre>";
        var_dump($generos);
        echo "</pre>";
    }

    public function showError($error) {
   //     require 'templates/error.phtml';
        echo "<pre>";
        var_dump($error);
        echo "</pre>";
    }

}