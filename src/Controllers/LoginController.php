<?php

namespace IdTravel\Challenge\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use IdTravel\Challenge\Providers\Airlines\AirlinesProviderId90Travel;
use IdTravel\Challenge\Providers\Auth\LoginProviderId90Travel;

class LoginController
{
    private LoginProviderId90Travel $loginProvider;
    private AirlinesProviderId90Travel $airlinesProvider;

    public function __construct()
    {
        $this->loginProvider = new LoginProviderId90Travel();
        $this->airlinesProvider = new AirlinesProviderId90Travel();
    }

    public function loginView(): void
    {
        echo view('login', [ 'airlines' => $this->getAirlines()]);
    }

    public function login($params): void
    {
        try {
            $session = $this->loginProvider->login($params);
            $_SESSION['session'] = $session;
            header("Location: http://localhost:8881/search", TRUE, 301);
        } catch (GuzzleException $e) {
            echo view('login', [
                'error' => 'Error interno. Intente mas tarde.',
                'airlines' => $this->getAirlines() ,
                'olds' => [
                    'airline' => $params['airline'],
                    'username' => $params['username'],
                    'remember_me' => $params['remember_me'] ?? false,
                ]
            ]);
        } catch (\Exception $e) {
            echo view('login', [
                'error' => $e->getMessage(),
                'airlines' => $this->getAirlines() ,
                'olds' => [
                    'airline' => $params['airline'],
                    'username' => $params['username'],
                    'remember_me' => $params['remember_me'] ?? false,
                ]
            ]);
        }
    }

    public function logout(): void
    {
        unset($_SESSION['session']);
        header("Location: http://localhost:8881/login", TRUE, 301);
    }

    private function getAirlines(): array
    {
        return $this->airlinesProvider->getAirlines();
    }
}