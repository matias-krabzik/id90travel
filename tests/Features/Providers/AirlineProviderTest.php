<?php

namespace Tests\Features\Providers;

use Tests\TestCase;

class AirlineProviderTest extends TestCase
{
    public function testGetAirlines()
    {
        $provider = new \IdTravel\Challenge\Providers\Airlines\AirlinesProviderId90Travel();
        $airlines = $provider->getAirlines();
        $this->assertIsArray($airlines);
        $this->assertNotEmpty($airlines);
    }

}