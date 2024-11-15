<?php

namespace Dwes\ProyectoVideoclub;

include_once "autoload.php";

abstract class Soporte implements Resumible
{
    public $titulo;
    protected $numero = 0;
    private $precio;
    public $alquilado=false;

    static $contSoporte = 0;

    const IVA = 1.21;

    public function __construct($titulo, $numero, $precio)
    {
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->numero = $numero;
        self::$contSoporte = $numero;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPrecioConIva()
    {
        return $this->precio * self::IVA;
    }

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @return int
     */
    public static function getContSoporte()
    {
        return self::$contSoporte;
    }

    public function isAlquilado(): bool
    {
        return $this->alquilado;
    }

    public function setAlquilado(bool $alquilado)
    {
        $this->alquilado = $alquilado;
    }


    function muestraResumen()
    {

        echo "<br>" . $this->titulo;
        echo "<br>" . $this->precio . " € (IVA no incluido)";


    }

}