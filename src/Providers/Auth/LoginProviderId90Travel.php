<?php

namespace IdTravel\Challenge\Providers\Auth;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use IdTravel\Challenge\Repositories\Auth\LoginRepository;

class LoginProviderId90Travel implements LoginProviderInterface
{
    /**
     * @throws Exception
     * @throws GuzzleException
     */
    public function login($params): array
    {
        $response = (new LoginRepository())->login($params);
        if ($response->getStatusCode() !== 200) {
            throw new Exception('Credenciales invalidas.');
        }
        return json_decode($response->getBody()->getContents(), true);
    }
}