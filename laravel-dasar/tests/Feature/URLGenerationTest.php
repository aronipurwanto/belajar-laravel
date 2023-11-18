<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get('/url/current?name=roni')
            ->assertSeeText('/url/current?name=roni');
    }

    public function testNamed()
    {
        $this->get('/redirect/named',)
            ->assertSeeText('http://localhost/redirect/name/roni');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('form');
    }

}
