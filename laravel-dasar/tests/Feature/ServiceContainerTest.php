<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Service\HelloService;
use App\Service\HelloServiceEng;
use App\Service\HelloServiceIndo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        //$person = $this->app->make(Person::class);
        //self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app){
           return new Person("Roni", "Purwanto");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        assertEquals("Roni", $person1->firstName);
        assertEquals("Roni", $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app){
            return new Person("Roni", "Purwanto");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Roni", $person1->firstName);
        self::assertEquals("Roni", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Roni","Purwanto");

        $this->app->instance(Person::class, $person );

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Roni", $person1->firstName);
        self::assertEquals("Roni", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjectionFooBar()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app){
            return new Bar($app->make(Foo::class));
        });


        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo );
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndo::class);
        $helloService = $this->app->make(HelloService::class);

        self::assertEquals("Halo Roni", $helloService->hello("Roni"));

        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceEng();
        });
        $hello = $this->app->make(HelloService::class);
        self::assertEquals("Hello Roni", $hello->hello("Roni"));
    }


}
