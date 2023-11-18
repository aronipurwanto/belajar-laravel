<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get ('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');

        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');
        $firstName3 = $config->get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName2, $firstName3);
        var_dump(Config::all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
        ->with('contoh.author.first')
        ->andReturn('Roni Ganteng');

        //Log::shouldReceive();
        //App::shouldReceive();
        //Crypt::shouldReceive();

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Roni Ganteng', $firstName);

    }


}
