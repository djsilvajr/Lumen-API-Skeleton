<?php

namespace App\Service;

use App\Models\UserApi;

class UserApiService extends UserApi
{
    public function recuperarUsuarioPorId($id) {
        $retorno = $this->queryUsuarioPorId($id);
        if(empty($retorno)) {
            return response()->json(array(
                'status' => false,
                'message' => 'Não foi encontrado usuario para este ID',
                'dados' => null
            ), 404);
        }

        return response()->json(array(
            'status' => false,
            'message' => 'Dados recuperados com sucesso.',
            'dados' => $retorno
        ), 200);
    }
}
