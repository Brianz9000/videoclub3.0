<?php

class Cliente
{
    public $nombre;
    private $numero;
    private $soportesAlquilados = array();
    private $numSoportesAlquilados;
    private $maxAlquilerConcurrente;


    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }


    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getNumSoportesAlquilados()
    {
        return $this->numSoportesAlquilados;
    }

    function tieneAlquilado(Soporte $s)
    {
        if (!empty($this->soportesAlquilados)) {
            return in_array($s, $this->soportesAlquilados);
        }
    }

    function alquilar(Soporte $s)
    {
        $tiene = count($this->soportesAlquilados);
        if (!$this->tieneAlquilado($s)) {
            if ($tiene < $this->maxAlquilerConcurrente) {
                $this->soportesAlquilados[] = $s;
                $this->numSoportesAlquilados += 1;

                echo "<br><br><strong>Alquilado soporte a: </strong>" . $this->nombre;
                echo "<br><br>".$s->muestraResumen();
            } else {
                echo "<br><br>Este cliente tiene 3 elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo";
            }
        } else {
            echo "<br>El cliente ya tiene alquilado el soporte <strong>" . $s->titulo . "</strong>";
        }

    }

    function devolver($nunSoporte)
    {
        if (empty($this->soportesAlquilados)) {

            echo "<br>Este cliente no tiene alquilado ningún elemento";
        } else {
            $objEncontrado = -1;

            foreach ($this->soportesAlquilados as $s) {
                if ($s->getNumero() === $nunSoporte) {
                    $objEncontrado += 1;
                }
            }
            if ($objEncontrado > -1) {
                array_splice($this->soportesAlquilados, $objEncontrado, 1);
                $this->numSoportesAlquilados--;
            } else {
                echo "<br><br>No se ha podido encontrar el soporte en los alquileres de este cliente";
            }
        }
    }

    function listaAlquileres()
    {
        if (!empty($this->soportesAlquilados)) {
            echo "<br><br><strong>El cliente tiene" . $this->numSoportesAlquilados . " soportes alquilados</strong><br>";
            foreach ($this->soportesAlquilados as $s) {
                echo "<br><br>" . $s->muestraResumen();
            }
        } else {
            echo "<br>Este cliente no tiene alquilado ningún elemento";
        }
    }

    function muestraResumen()
    {
        echo "<br>" . $this->nombre;
        echo "<br>" . count($this->soportesAlquilados);
    }


}