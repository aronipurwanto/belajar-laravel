<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreate()
    {
        $this->get('/cookie/set')
            ->assertCookie('User-Id','Roni Purwanto')
            ->assertCookie('Is-Member','true');
    }

    public function testGet()
    {
        $this->get('/cookie/get')
            ->assertSeeText('userId')
            ->assertSeeText('guest')
            ->assertSeeText('false')
            ->assertSeeText('isMember');

        $this->withCookie('User-Id','Roni')
            ->withCookie('Is-Member','true')
            ->get('/cookie/get')
            ->assertJson([
               'userId' => 'Roni',
               'isMember' => 'true'
            ]);
    }
}
