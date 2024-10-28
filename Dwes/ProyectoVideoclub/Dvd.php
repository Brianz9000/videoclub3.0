<?php

namespace Dwes\ProyectoVideoclub;

include_once "autoload.php";

class Dvd extends Soporte
{

    public $idiomas;
    private $formatoPantalla;

    public function __construct($titulo, $precio, $idiomas, $formatoPantalla)
    {
        parent::__construct($titulo, (self::$contSoporte + 1), $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    function muestraResumen()
    {
        echo "<br>";
        echo $this->getNumero() . " .- Pelicula en DVD:";
        parent::muestraResumen();
        echo "<br>Idiomas: " . $this->idiomas;
        echo "<br>Formato Pantalla: " . $this->formatoPantalla;
    }


}