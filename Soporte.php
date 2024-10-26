<?php

class Soporte
{
    public $titulo;
    protected $numero;
    private $precio;

     const IVA = 1.21;

    public function __construct($titulo, $numero, $precio)
    {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPrecioConIva(){
        return $this->precio *  self::IVA;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    function muestraResumen()
    {
        echo "<br>";
        echo  $this->titulo."<br>".$this->precio;

    }

}