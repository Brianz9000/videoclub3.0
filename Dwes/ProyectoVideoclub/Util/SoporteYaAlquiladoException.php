<?php

namespace Dwes\ProyectoVideoclub\Util;
include_once "autoload.php";

class SoporteYaAlquiladoException extends VideoclubException
{
    public function __construct($mensaje)
    {
        parent::__construct($mensaje);
    }
}