<?php
include_once "Juego.php";
include_once "Dvd.php";
include_once "CintaVideo.php";
include_once "Soporte.php";
include_once "Cliente.php";

class Videoclub
{

    private $nombre;
    private $productos = array();
    private $numProductos=0;
    private $socios = array();
    private $numSocios=0;


    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    private function incluirProducto(Soporte $producto)
    {
        $this->productos[] = $producto;
        echo "<br>Incluido soporte ".$this->numProductos;
        $this->numProductos+=1;

    }

    function incluirCintaVideo($titulo, $precio, $duracion)
    {
        $cintaVideo = new CintaVideo($titulo, $precio, $duracion);
        $this->incluirProducto($cintaVideo);
    }

    function incluirDvd($titulo, $precio, $idiomas, $pantalla)
    {
        $dvd = new Dvd($titulo, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd);

    }

    function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ)
    {
        $juego = new Juego($titulo, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);
    }

    function incluirSocio($nombre, $maxAlquileresConcurrentes = 3)
    {
        $cliente = new Cliente($nombre, $maxAlquileresConcurrentes);
        $this->socios[] = $cliente;
        echo "<br>Incluido socio ".$this->numSocios;
        $this->numSocios += 1;
    }

    function listarProductos()
    {
        if (!empty($this->productos)) {
            echo "<br><br><br>Listado de los".count($this->productos)." productos disponibles: ";
            foreach ($this->productos as $producto) {
                echo "<br>". $producto->muestraResumen();
            }
        } else {
            echo "<br>No tienes productos";
        }
    }

    function listarSocios()
    {
        if (!empty($this->socios)) {
            echo "<br><br><br>Listado de ".count($this->socios)." socios del videoclub: ";

            foreach ($this->socios as $socio) {
                echo "<br>".$socio->muestraResumen();

            }
        } else {
            echo "<br>No tienes socios";
        }
    }

    function alquilaSocioProducto($numeroCliente,$numeroSoporte)
    {

        echo "<br>";

        $cliente;
        $soporte;
        foreach ($this->socios as $cliente) {
            if ($numeroCliente == $cliente->getNumero()) {
                $cliente = $cliente;
            }
        }
        foreach ($this->productos as $producto) {
            if ($numeroSoporte == $producto->getNumero()) {
                $soporte = $producto;
            }
        }

        if ($cliente != null && $soporte != null) {
            $cliente->alquilar($soporte);

        } else {
            echo "error";
        }


    }

}