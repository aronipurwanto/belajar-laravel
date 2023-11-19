<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EachTest extends TestCase
{
    public function testEach()
    {
        $this->view("each", ["users" => [
            [
                "name" => "Roni",
                "hobbies" => ["Coding", "Gaming"]
            ],
            [
                "name" => "Purwanto",
                "hobbies" => ["Coding", "Gaming"]
            ]
        ]])
            ->assertSeeInOrder([
                ".red",
                "Roni",
                "Coding",
                "Gaming",
                "Purwanto",
                "Coding",
                "Gaming"
            ]);
    }
}
