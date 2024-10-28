<?php

namespace Dwes\ProyectoVideoclub\Util;
include_once "autoload.php";

class CupoSuperadoException extends VideoclubException
{
 public function __construct($message)
 {
     parent::__construct($message);
 }
}