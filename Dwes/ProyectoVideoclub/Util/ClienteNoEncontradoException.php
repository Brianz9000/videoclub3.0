<?php
namespace Dwes\ProyectoVideoclub\Util;
include_once "autoload.php";

class ClienteNoEncontradoException extends VideoclubException
{
    public function __construct($mensaje)
    {
        parent::__construct($mensaje);
    }
}