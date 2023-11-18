<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            'user'=>'ahmadroni'
        ])->get('/login')
            ->assertRedirect('/');
    }


    public function testLoginSuccess()
    {
        $this->post('/login',[
            'user'=>"ahmadroni",
            "password"=>"rahasia"
        ])->assertRedirect("/");
    }

    public function testLoginAlreadyLogin()
    {
        $this->withSession([
            'user'=>'ahmadroni'
        ])
            ->post('/login',[
            'user'=>"ahmadroni",
            "password"=>"rahasia"
        ])->assertRedirect("/");
    }

    public function testValidationError()
    {
        $this->post('/login',[
            'user'=>"ahmadroni",
        ])->assertSeeText("Login")
        ->assertSeeText("User or password is required");

        $this->post('/login',[] )->assertSeeText("Login")
            ->assertSeeText("User or password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login',[
            'user'=>"ahmadroni",
            "password"=>"salah"
        ])->assertSeeText("Login")
        ->assertSeeText("User or password wrong ");
    }

    public function testLogout()
    {
        $this->withSession([
            'user'=>'ahmadroni'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }


}
