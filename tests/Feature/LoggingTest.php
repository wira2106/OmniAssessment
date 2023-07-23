<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class LoggingTest extends TestCase
{
    public function testLogging(){
        Log::info("Hello Info");
        Log::warning("Hello warning");
        Log::error("Hello Error");
        Log::critical("Hello Critical");
        self::assertTrue(true);
    }
}
