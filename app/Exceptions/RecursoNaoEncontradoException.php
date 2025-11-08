<?php

namespace App\Exceptions;

use Exception;

class RecursoNaoEncontradoException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'status' => false,
            'message' => $this->getMessage(),
            'dados' => []
        ], 404);
    }
}