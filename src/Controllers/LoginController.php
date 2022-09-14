<?php

namespace IdTravel\Challenge\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use IdTravel\Challenge\Providers\AirlinesProvider;
use IdTravel\Challenge\Providers\LoginProvider;
use IdTravel\Challenge\Repositories\Airline\AirlineRepository;
use IdTravel\Challenge\Repositories\Auth\LoginRepository;

class LoginController
{

    public function loginView(): void
    {
        echo view('login', [ 'airlines' => $this->getAirlines()]);
    }

    public function login($params): void
    {
        $provider = new LoginProvider();
        $response = $provider->login(new LoginRepository(), $params);

        if ($response->getStatusCode() === 200) {
            session_start();
            $_SESSION['session'] = json_decode($response->getBody()->getContents());
            header("Location: http://localhost:8881/search", TRUE, 301);
            exit();
        }

        echo view('login', [
            'error' => 'Invalid credentials',
            'airlines' => $this->getAirlines() ,
            'olds' => [
                'airline' => $params['airline'],
                'username' => $params['username'],
                'remember_me' => $params['remember_me'] ?? false,
            ]
        ]);
    }

    public function logout(): void
    {
        session_start();
        unset($_SESSION['session']);
        header("Location: http://localhost:8881/login", TRUE, 301);
    }

    private function getAirlines(): array
    {
        $provider = new AirlinesProvider();
        return json_decode($provider->getAirlines(new AirlineRepository())->getBody()->getContents());
    }
}