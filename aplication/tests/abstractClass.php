<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Persona {

    abstract public function saludo();
}

class Cheto extends Persona {

    private $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function saludo(){
        echo "Qui haces man, to' bien<br>";
    }

}

class Negro extends Persona {

    private $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    private function getNombre() {
        return $this->nombre;
    }

    public function saludo($unValor = 2, $otroValor = 5) {
        echo "Eh kse ameho, no tene 5 pe pa tomar con los pi, ese vino en la pla za<br>";
    }

}

$adro = new Cheto("Adro");
$adro->saludo();

$elKevin = new Negro("El Kevin");
$elKevin->saludo(3, 4);
