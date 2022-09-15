<?php

namespace IdTravel\Challenge\Providers\Auth;

interface LoginProviderInterface
{
    public function login($params): array;
}