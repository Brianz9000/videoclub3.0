<?php

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException;

include_once "autoload.php";

class Videoclub
{

    private $nombre;
    private $productos = array();
    private $numProductos = 0;
    private $socios = array();
    private $numSocios = 0;


    public $numProductosAlquilados;
    public $numTotalAlquileres;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNumProductosAlquilados()
    {
        return $this->numProductosAlquilados;
    }

    public function setNumProductosAlquilados($numProductosAlquilados)
    {
        $this->numProductosAlquilados = $numProductosAlquilados;
    }

    public function getNumTotalAlquileres()
    {
        return $this->numTotalAlquileres;
    }

    public function setNumTotalAlquileres($numTotalAlquileres)
    {
        $this->numTotalAlquileres = $numTotalAlquileres;
    }

    //alquilarSocioProductos(int numSocio, array numerosProductos), el cual debe recibir un array con los productos a alquilar.
    //dice array de productos, no array de numeros de producto
    function alquilarSocioProductos($numSocio, array $numerosProductos)
    {
        $cantidadProductos = count($numerosProductos);
        $cont = 0;
        foreach ($numerosProductos as $s) {
            if (!$s->isAlquilado()) {
                $cont++;
            }
        }
        if ($cont == $cantidadProductos) {
            foreach ($numerosProductos as $s) {
                $this->alquilarSocioProductos($numSocio, $s->getNumero());
            }
        } else {
            echo "<br>algun producto ya esta alqilado";
        }
    }

    //por si es un array de numero de soporte de productos
    //esta claro que si estan listos para alquilar deben estar agregados al array de productos
    function alquilarSocioProductos2($numSocio, array $numerosProductos)
    {
        $cantidadProductos = count($numerosProductos);
        $cont = 0;
        $socio = $this->existeSocio($numSocio);
        $nuevoArray = $this->objetosProductoFiltrado($numerosProductos);
        if ($socio != null && $nuevoArray != null) {
            foreach ($nuevoArray as $s) {
                if (!$s->isAlquilado()) {
                    $cont++;
                }
            }
            if ($cont == $cantidadProductos) {
                foreach ($nuevoArray as $p) {
                    $socio->alquilar($p);
                }
            }else{
                echo "<br>algun producto ya esta alquilado";
            }
        } else {
            throw new ClienteNoEncontradoException("Socio no existe");
        }
    }


    function devolverSocioProducto($numSocio, $numeroProducto)
    {
        $socio = $this->existeSocio($numSocio);

        if ($socio != null && $numeroProducto != null) {
            $socio->devolver($numeroProducto);
        }
        return $this;
    }

    function devolverSocioProductos($numSocio, array $numerosProductos)
    {
        $socio = $this->existeSocio($numSocio);
        $array = $this->objetosProductoFiltrado($numerosProductos);
        if ($socio != null && $array != null) {
            foreach ($array as $p) {
                if ($p->isAlquilado()) {
                    $this->devolverSocioProducto($numSocio, $p->getNumero());
                }
            }
        } else {
            echo "<br>Error";
        }
        return $this;

    }

    function objetosProductoFiltrado(array $numerosProductos)
    {
        $nuevoArray = [];
        foreach ($this->productos as $p) {
            if (in_array($p->getNumero(), $numerosProductos)) {
                $nuevoArray[] = $p;
            }
        }
        return $nuevoArray;
    }


    function existeSocio($numSocio)
    {
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numSocio) {
                return $socio;
            }
        }
        return null;
    }

    function existeProducto($numProducto)
    {
        foreach ($this->productos as $producto) {
            if ($producto->getNumero() == $numProducto) {
                return $producto;
            }
        }
        return null;
    }


    private function incluirProducto(Soporte $producto)
    {
        $this->productos[] = $producto;
        echo "<br>Incluido soporte " . $this->numProductos;
        $this->numProductos += 1;

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
        echo "<br>Incluido socio " . $this->numSocios;
        $this->numSocios += 1;
    }

    function listarProductos()
    {
        if (!empty($this->productos)) {
            echo "<br><br><br>Listado de los" . count($this->productos) . " productos disponibles: ";
            foreach ($this->productos as $producto) {
                echo "<br>" . $producto->muestraResumen();
            }
        } else {
            echo "<br>No tienes productos";
        }
    }

    function listarSocios()
    {
        if (!empty($this->socios)) {
            echo "<br><br><br>Listado de " . count($this->socios) . " socios del videoclub: ";

            foreach ($this->socios as $socio) {
                echo "<br>" . $socio->muestraResumen();

            }
        } else {
            echo "<br>No tienes socios";
        }
    }

    function alquilaSocioProducto($numeroCliente, $numeroSoporte)
    {

        $socio = $this->existeSocio($numeroCliente);
        $producto = $this->existeProducto($numeroSoporte);

        echo "<br>";

        if ($socio != null && $producto != null) {
            $socio->alquilar($producto);
        }else{
            throw new ClienteNoEncontradoException("Cliente no encontrado");

        }
        return $this;

    }

}