<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=roni')
            ->assertSeeText('Hello roni');

        $this->post('/input/hello',['name'=>'roni'])
            ->assertSeeText('Hello roni');
    }

    public function testNameFirst()
    {
        $this->post('/input/hello/first',[
            'name'=>[
                "first" => "Roni",
                "last" => "purwanto"
            ]
        ])->assertSeeText("Hello Roni");
    }

    public function testHelloInput()
    {
        $this->post('/input/hello/input',[
            'name'=>[
                "first" => "Roni",
                "last" => "purwanto"
            ]
        ])->assertSeeText("name")->assertSeeText('first')->assertSeeText('name')
        ->assertSeeText('Roni')->assertSeeText('purwanto ');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/input-array',[
            'products'=>[
                [
                    "name" => "Apple M1",
                    "price"=>100000
                ],
                [
                    "name" => "Apple M2",
                    "price" => 20000
                ],
                [
                    "name" => "Apple M2 Pro",
                    "price" => 30000
                ]
            ]
        ])->assertSeeText("Apple M1")->assertSeeText('Apple M2')->assertSeeText('Apple M2 Pro');
    }

    public function testInputType()
    {
        $this->post('/input/hello/input-type',[
            'name'=>'Roni Purwanto',
            'married'=>true,
            'birth_date' => '2000-01-01'
        ])->assertSeeText("name")->assertSeeText('married')->assertSeeText('birth_date')
        ->assertSeeText('Roni Purwanto')->assertSeeText('2000-01-01') ;
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name"=> [
                "first" => "Ahmad",
                "middle" => "Roni",
                "last" => "Purwanto"
            ]
        ])->assertSeeText("Ahmad")->assertSeeText("Purwanto")
        ->assertSeeText("Roni");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "user"=> "AhmadRoni",
            "admin"=>"true",
            "password"=>"password"
        ])->assertSeeText("AhmadRoni")->assertSeeText("password")
            ->assertSeeText("true");
    }


}
