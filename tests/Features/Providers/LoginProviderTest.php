<?php

namespace Tests\Features\Providers;

use Tests\TestCase;

class LoginProviderTest extends TestCase
{
    public function testLogin()
    {
        $provider = new \IdTravel\Challenge\Providers\Auth\LoginProviderId90Travel();
        $response = $provider->login([
            'airline' => 'F9',
            'username' => 'f9user',
            'password' => '123456',
            'remember_me' => true
        ]);
        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody()->getContents());
    }

    public function testLoginWithInvalidCredentials()
    {
        $provider = new \IdTravel\Challenge\Providers\Auth\LoginProviderId90Travel();
        $response = $provider->login([
            'airline' => 'F9',
            'username' => 'fake_user',
            'password' => '1234567_false',
            'remember_me' => true
        ]);
        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $response);
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertJson($response->getBody()->getContents());
    }
}