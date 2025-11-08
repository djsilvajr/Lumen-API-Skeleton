<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ErroDeValidacaoException extends Exception
{
    protected array $erros;

    public function __construct(string $message = 'Erro de validação nos dados enviados.', array $erros = [])
    {
        parent::__construct($message);
        $this->erros = $erros;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $this->getMessage(),
            'erros' => $this->erros
        ], 400);
    }
}
?>