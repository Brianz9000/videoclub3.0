<?php

namespace Dwes\ProyectoVideoclub\Util;

use Exception;
use Throwable;
set_exception_handler(function ($exception) {
    // Aquí puedes personalizar cómo se muestran todas las excepciones
    echo  $exception->getMessage();
});
class VideoclubException extends Exception implements Throwable {
    public function __construct($message)
    {
        parent::__construct($message);
    }

}