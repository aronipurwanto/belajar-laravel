<?php

namespace App\Services;

class SayHello
{
    function sayhello(string $name) : string
    {
        return "Hello ${name}";
    }

}
