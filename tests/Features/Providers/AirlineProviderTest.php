<?php

namespace Tests\Features\Providers;

use Tests\TestCase;

class AirlineProviderTest extends TestCase
{
    public function testGetAirlines()
    {
        $provider = new \IdTravel\Challenge\Providers\AirlinesProvider();
        $response = $provider->getAirlines();
        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody()->getContents());
    }

}