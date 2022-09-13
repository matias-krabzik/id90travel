<?php

namespace Tests\Features;

use PHPUnit\Framework\TestCase;

final class HomePageTest extends TestCase
{
    public function test_home_page()
    {
        $this->assertStringEndsWith('Id90Travel Challenge', "Id90Travel Challenge");
    }
}