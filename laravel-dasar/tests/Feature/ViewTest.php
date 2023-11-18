<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Roni');

        $this->get('/hello-again')
            ->assertSeeText('Hello Roni');
    }

    public function testHelloWorld()
    {
        $this->get('/hello-world ')
            ->assertSeeText('Hello Roni');
    }

    public function testTemplate()
    {
        $this->view('hello',['name' => 'Roni'])
            ->assertSeeText('Hello Roni');

        $this->view('hello.world',['name' => 'Roni'])
            ->assertSeeText('Hello Roni');
    }


}
