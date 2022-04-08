<?php

namespace App\Module\Survey;

class SurveyPrinter 
{ 
    public static function printSurvey(object $survey): void
    { 
        if (file_exists("./data/" . $survey->getParameterEmail() . ".txt"))
        {
            echo 'First name:' . $survey->getParameterFirstName() . PHP_EOL . 'Last name:' . $survey->getParameterLastName() . PHP_EOL . 'Email:' . $survey->getParameterEmail() . PHP_EOL . 'Age:' . $survey->getParameterAge() . PHP_EOL;
        }
        else
        {
            echo "Error printing: no such file or directory" . PHP_EOL;
        }
    }
}