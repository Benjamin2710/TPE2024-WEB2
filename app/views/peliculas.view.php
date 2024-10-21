<?php

class PeliculasView {
    private $res;

    public function __construct($res = null) {
        $this->res = $res;
    }
    public function showPeliculas($peliculas, $generos) {
        require 'templates/listaPeliculas.phtml';
    }

    public function showPelicula($pelicula, $generos) {
        require 'templates/item.phtml';
    }

    public function showFormAltaPelicula($generos) {
        require 'templates/formAltaPelicula.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
     //prueba
    // Mostrar la lista de géneros
    public function showGeneros($generos){
        require 'templates/listaGeneros.phtml';
    }

    public function showGenero($genero){
        require 'templates/itemGenero.phtml';
        test_var($genero);
    }

    public function showFormAltaGenero(){
        require 'templates/formNuevoGenero.phtml';
    }
}
