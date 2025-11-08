<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\UserApi;
use Illuminate\Support\Facades\Hash;
use App\Service\UserApiService;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $user = UserApi::where('email', $credentials['email'])->first();

        if (!$user || !\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Credenciais inválidas',
                'dados' => null
            ], 401);
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível criar o token',
                'dados' => null
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Validação bem sucedida.',
            'token' => $token,
            'dados' => [
                'id' => $user->id,
                'nome' => $user->nome,
                'email' => $user->email
            ]
        ], 200);
    }

    public function usuario()
    {
        return response()->json(JWTAuth::parseToken()->authenticate());
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'status' => true,
            'message' => 'Logout realizado com sucesso',
            'dados' => null
        ], 200);
    }

    public function usuarioId($id)
    {

        if(!$id) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi encontrado valor valida como parâmetro',
                'dados' => null,
                'erros' => [
                    'Envio de ID como parâmetro é obrigatório',
                ]
            ], 422);
        }

        $UserApiService = new UserApiService();
        return $UserApiService->recuperarUsuarioPorId($id);
    }

}
