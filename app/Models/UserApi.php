<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\DatabaseMysql;

class UserApi extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable; 

    protected $table = 'api_usuarios'; 
    protected $fillable = ['nome', 'email', 'password'];

    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function queryUsuarioPorId(int $id) : array {

        $db = new DatabaseMysql();

        $query = "SELECT
                id,
                nome,
                email
                created_at,
                updated_at
            FROM
                api_usuarios
            WHERE
                id = ?    
        ";

        $usuario = $db->selectOne($query, [$id]);

        if(!$usuario) {
            return [];
        }
        
        return $usuario;
    }
}
