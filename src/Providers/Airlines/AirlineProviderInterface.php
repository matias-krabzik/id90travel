<?php

namespace IdTravel\Challenge\Providers\Airlines;

interface AirlineProviderInterface
{
    public function getAirlines(): array;
}