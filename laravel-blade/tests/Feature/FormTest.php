<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormTest extends TestCase
{
    public function testForm()
    {
        $this->view("form", ["user" => [
            "premium" => true,
            "name" => "Roni",
            "admin" => true
        ]])
            ->assertSee("checked")
            ->assertSee("Roni")
            ->assertDontSee("readonly");

        $this->view("form", ["user" => [
            "premium" => false,
            "name" => "Roni",
            "admin" => false
        ]])
            ->assertDontSee("checked")
            ->assertSee("Roni")
            ->assertSee("readonly");
    }
}
