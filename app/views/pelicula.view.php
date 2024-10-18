<?php
class peliculaView {



    public function showError() {
        require 'templates/error.phtml';
    }
    public function showPeliculas($peliculas, $generos){
        require 'templates/header.phtml';
        require 'templates/peliculas.phtml';
    }
    public function viewHome(){
        require 'templates/header.phtml';
        require 'templates/footer.phtml';
    }
    public function viewAdministrar($peliculas, $generos){
        require 'templates/adminPeliculas.phtml';
        require 'templates/footer.phtml';
    }
}
