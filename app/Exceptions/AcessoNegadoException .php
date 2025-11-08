<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcessoNegadoException extends Exception
{
    protected array $detalhes;

    public function __construct(string $message = 'Você não tem permissão para executar esta ação.', array $detalhes = [])
    {
        parent::__construct($message);
        $this->detalhes = $detalhes;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $this->getMessage(),
            'dados' => $this->detalhes
        ], 403); // 403 Forbidden: usuário autenticado, mas sem permissão
    }
}
?>