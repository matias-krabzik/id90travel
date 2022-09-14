<?php

namespace IdTravel\Challenge\Providers;

use IdTravel\Challenge\Repositories\Auth\LoginRepository;

class LoginProvider
{
    public function login($params): \Psr\Http\Message\ResponseInterface
    {
        return (new LoginRepository())->login($params);
    }
}