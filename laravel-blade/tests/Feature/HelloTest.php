<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloTest extends TestCase
{
    public function testHello()
    {
        $this->get('/hello')
            ->assertSeeText('Laravel');
    }

    public function testWorld()
    {
        $this->get('/world')
            ->assertSeeText('Laravel');
    }

    public function testHelloView()
    {
        $this->view('hello',['name'=>'Roni'])
            ->assertSeeText('Roni');
    }

    public function testWorldView()
    {
        $this->view('hello.world',['name'=>'Roni'])
            ->assertSeeText('Roni');
    }

}
