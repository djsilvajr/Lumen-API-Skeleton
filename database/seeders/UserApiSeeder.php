<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\UserApi;

class UserApiSeeder extends Seeder
{
    public function run()
    {
        UserApi::create([
            'nome' => 'PADRAO',
            'email' => 'douglas.junior@teste.com.br',
            'password' => Hash::make('12345678'), // padrão seguro
        ]);
    }
}