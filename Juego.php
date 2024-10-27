<?php

class Juego extends Soporte
{

    public $consola;
    private $minNumJugadores;
    private $maxNumJugadores;

    public function __construct($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }


    function muestraJugadoresPosibles()
    {
        if ($this->minNumJugadores == 1 && $this->maxNumJugadores == 1) {
            echo "Para un jugador";
        } elseif ($this->minNumJugadores == $this->maxNumJugadores) {
            echo "Para " . $maxNumJugadores . " jugadores";
        } else {
            echo "De " . $minNumJugadores . " a " . $this->maxNumJugadores . " jugadores";
        }
    }

    function muestraResumen()
    {
        echo "<br>Juego para: " . $this->consola;
        parent::muestraResumen();
        echo "<br>";
        $this->muestraJugadoresPosibles();

    }

}