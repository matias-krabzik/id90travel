<?php

namespace Tests\Features\Providers;

use Tests\TestCase;

class LoginProviderTest extends TestCase
{
    public function testLogin()
    {
        $provider = new \IdTravel\Challenge\Providers\Auth\LoginProviderId90Travel();
        $credentials = $provider->login([
            'airline' => 'F9',
            'username' => 'f9user',
            'password' => '123456',
            'remember_me' => true
        ]);
        $this->assertIsArray($credentials);
        $this->assertArrayHasKey('member', $credentials);
        $this->assertNotEmpty($credentials);
    }

    public function testLoginWithInvalidCredentials()
    {
        $provider = new \IdTravel\Challenge\Providers\Auth\LoginProviderId90Travel();
        try {
            $credentials = $provider->login([
                'airline' => 'F9',
                'username' => 'fake_user',
                'password' => '1234567_false',
                'remember_me' => true
            ]);
        } catch (\Exception $e) {
            $this->assertEquals('Credenciales invalidas.', $e->getMessage());
        }
    }
}