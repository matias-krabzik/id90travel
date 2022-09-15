<?php

namespace IdTravel\Challenge\Providers\Hotels;

interface HotelProviderInterface
{
    public function search($params): array;
}