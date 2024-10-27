<?php
include_once "Soporte.php";
class CintaVideo extends Soporte{

    private $duracion;

    public function __construct($titulo, $numero, $precio,$duracion)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion = $duracion;
    }

    function muestraResumen()
    {
        echo "<br>";
        echo "Pelicula en VHS:";
        parent::muestraResumen();
        echo "<br>Duracion: ".$this->duracion." minutos";
    }


}