<?php

class PeliculasView {
    private $res;

    public function __construct($res = null) {
        $this->res = $res;
    }
    public function showPeliculas($peliculas) {
        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        // require 'templates/lista_tareas.phtml';
        require 'templates/listaPeliculas.phtml';
    }

    public function showPelicula($pelicula) {
        require 'templates/item.phtml';
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
     //prueba
    // Mostrar la lista de géneros
    public function showGeneros($generos){
        require 'templates/layout/header.phtml';
        echo "<h1>Lista de Géneros de Películas</h1>";
        echo "<ul>";
        foreach ($generos as $genero) {
            echo "<li><strong>{$genero->nombre}</strong>: {$genero->descripcion} (Clasificación: {$genero->clasificacion_por_edad})</li>";
        }
        echo "</ul>";
    }
}
