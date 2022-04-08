<?php

namespace App\Module\Survey;

class RequestSurveyLoader
{
    private object $survey;

    public function createNewSurvey(string $firstName, string $lastName, string $email, string $age): ?object
    { 
        $firstName = $_GET[$firstName] ?? null;
        $lastName = $_GET[$lastName] ?? null;
        $email = $_GET[$email] ?? null;
        $age = $_GET[$age] ?? null;

        if ($email)
        {
            $this->survey = new Survey($firstName, $lastName, $email, $age);
            return $this->survey;
        }
        else
        {
            echo "don't got email!" . PHP_EOL;
            return null;
        }
    }
}