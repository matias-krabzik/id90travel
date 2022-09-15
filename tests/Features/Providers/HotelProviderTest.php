<?php

namespace Tests\Features\Providers;

use Tests\TestCase;

class HotelProviderTest extends TestCase
{
    public function testSearch()
    {
        $provider = new \IdTravel\Challenge\Providers\Hotels\HotelProviderId90Travel();
        $search = $provider->search([
            'destination' => 'Lima',
            'checkin' => '2020-01-01',
            'checkout' => '2020-01-02',
            'guests' => 1,
        ]);
        $this->assertIsArray($search);
        $this->assertNotEmpty($search);
    }

}