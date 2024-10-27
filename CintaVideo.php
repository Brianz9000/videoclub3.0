<?php
include_once "Soporte.php";
class CintaVideo extends Soporte{

    private $duracion;

    public function __construct($titulo,$precio,$duracion)
    {
        parent::__construct($titulo,(self::$contSoporte+1), $precio);
        $this->duracion = $duracion;
    }

    function muestraResumen()
    {
        echo "<br>";
        echo $this->getNumero().".- Pelicula en VHS:";
        parent::muestraResumen();
        echo "<br>Duracion: ".$this->duracion." minutos";
    }


}