<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHello()
    {
        $this->get('/controller/hello')
            ->assertSeeText('Hello World');
    }

    public function testSayHello()
    {
        $this->get('/controller/say-hello/Roni')
            ->assertSeeText("Halo Roni");
    }

    public function testRequest()
    {
        $this->get('/controller/request',[
            'Accept' => "plain/text"
        ])->assertSeeText("controller/request")
            ->assertSeeText('http://localhost/controller/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
    }


}
