<?php

namespace App\Requests;

use App\Contracts\Requests\RequestValidatorInterface;
use App\Exceptions\ErroDeValidacaoException;

class ExempleRequest implements RequestValidatorInterface{
    public static function validar($credentials) : void {
        if (!$credentials) { 
            throw new ErroDeValidacaoException("Parâmetros inválidos.", ['']);
        }
    }
}


?>