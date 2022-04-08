<?php

namespace App\Module\Greetings;

class PersonGreetings
{
    public function prepareAppeal(?string $userName): string
    {
        if ($userName === null || $userName === '') {
            $userName = 'anonymous';
        }

        return ucwords($userName);
    }
}