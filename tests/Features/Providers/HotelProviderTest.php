<?php

namespace Tests\Features\Providers;

use Tests\TestCase;

class HotelProviderTest extends TestCase
{
    public function testSearch()
    {
        $provider = new \IdTravel\Challenge\Providers\HotelProvider();
        $response = $provider->search([
            'destination' => 'Lima',
            'checkin' => '2020-01-01',
            'checkout' => '2020-01-02',
            'guests' => 1,
        ]);
        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody()->getContents());
    }

}