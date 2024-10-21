<?php

function test_var($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    echo "<br>";
}

function getGeneroNombre($generos, $id_genero) { //se usa en el form editpelicula
    foreach ($generos as $genero) {
        if ($genero->id == $id_genero) {
            return $genero->nombre;
        }
    }
    return 'Género no encontrado';
}
 
function quitarEspacios($string){
    $palabras = explode(' ', $string);
    $palabrasConMayusculas = array_map('ucfirst', $palabras);
    $stringConMayusculas = implode(' ', $palabrasConMayusculas);
    $stringSinEspacios = preg_replace('/\s+/', '', $stringConMayusculas);
    return $stringSinEspacios;
}