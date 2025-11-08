<?php

namespace App\Contracts\Requests;

interface RequestValidatorInterface
{
    /**
     * Valida os dados recebidos
     *
     * @param array $credentials
     * @return void
     * @throws \App\Exceptions\ParametrosInvalidosException
     */
    public static function validar($credentials): void;
}