<?php

namespace App\Models;

class Person
{
    public string $name;
    public string $department;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

}
