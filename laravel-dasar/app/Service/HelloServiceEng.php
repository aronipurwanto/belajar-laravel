<?php

namespace App\Service;

class HelloServiceEng implements HelloService
{

    public function hello(string $name): string
    {
        return "Hello ".$name;
    }
}
