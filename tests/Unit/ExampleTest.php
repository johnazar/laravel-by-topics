<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        Cache::shouldReceive('get')
            ->with('key')
            ->andReturn('value');

        $response = $this->get('/cache');

        $response->assertSee('value');
    }
    
}
