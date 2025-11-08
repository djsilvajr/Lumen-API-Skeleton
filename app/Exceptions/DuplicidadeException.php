<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DuplicidadeException extends Exception
{
    protected array $detalhes;

    public function __construct(string $message = 'Recurso já existe.', array $detalhes = [])
    {
        parent::__construct($message);
        $this->detalhes = $detalhes;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $this->getMessage(),
            'detalhes' => $this->detalhes
        ], 409); // 409 Conflict é o mais adequado para duplicidade
    }
}
?>