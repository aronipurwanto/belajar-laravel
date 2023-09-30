<?php

namespace App\Service;

class HelloServiceIndo implements HelloService
{

    public function hello(string $name): string
    {
        return "Halo ". $name;
    }
}
