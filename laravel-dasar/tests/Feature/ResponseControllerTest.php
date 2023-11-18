<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('hello response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertHeader('Content-Type','application/json')
            ->assertHeader('Author','Roni Purwanto')
            ->assertHeader('App','Belajar Laravel')
            ->assertSeeText('Purwanto')
            ->assertSeeText('Roni');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertStatus(200)
            ->assertSeeText('Hello Roni');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertStatus(200)
            ->assertSeeText('Purwanto')
            ->assertSeeText('Roni');
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertStatus(200)
            ->assertHeader('Content-Type','image/jpeg');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertStatus(200)
            ->assertDownload('roni.jpg');
    }
}
