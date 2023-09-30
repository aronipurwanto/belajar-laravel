<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $testEnv = env('TEST_ENV');
        self::assertEquals('Test',$testEnv);
    }

    public function testGetDefault(){
        $testEnv = env('AUTHOR','Roni');
        self::assertEquals('Roni',$testEnv);

        $default = Env::get('DEFAULT','Default Test');
        self::assertEquals('Default Test', $default);
    }
}
