<?php

namespace IdTravel\Challenge\Providers;

use IdTravel\Challenge\Repositories\Auth\LoginRepository;

class LoginProvider
{
    public function login(LoginRepository $repository, $params)
    {
        return $repository->login($params);
    }
}