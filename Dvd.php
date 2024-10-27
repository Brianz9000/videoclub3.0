<?php

class Dvd extends Soporte{

    public $idiomas;
    private $formatoPantalla;

    public function __construct($titulo, $numero, $precio,$idiomas,$formatoPantalla)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    function muestraResumen()
    {
        echo "<br>";
        echo "Pelicula en DVD:";
        parent::muestraResumen();
        echo "<br>Idiomas: ".$this->idiomas;
        echo "<br>Formato Pantalla: ".$this->formatoPantalla;
    }


}