<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/sitera')
            ->assertStatus(200)
            ->assertSeeText("welcome to sitera");
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/sitera');
    }

    public function testFallback()
    {
        $this->get('/404')
            ->assertSeeText('404');

        $this->get('/salah')
            ->assertSeeText('404');

        $this->get('/coba-salah')
            ->assertSeeText('404');

        $this->get('/salah-lagi')
            ->assertSeeText('404');
    }

    public function testRouteParameter()
    {
        $this->get('/product/1')
            ->assertSeeText('Product 1');

        $this->get('/product/2')
            ->assertSeeText('Product 2');

        $this->get('/product/1/item/123')
            ->assertSeeText('Product 1, Item 123');

        $this->get('/product/2/item/123')
            ->assertSeeText('Product 2, Item 123');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/category/1')
            ->assertSeeText('Category 1');

        $this->get('/category/abc')
            ->assertSeeText('404');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/roni')
            ->assertSeeText('User roni');

        $this->get('/users/')
            ->assertSeeText('User 404');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/product/12345');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/product/12345');
    }

}
