<?php

namespace App\Module\Survey;

class SurveyFileStorage  
{
    private mixed $file;
    private string $path;
    private string $content;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $age;
    private ?string $fileString;

    public function saveData(object $survey, object $storage): void
    {   
        $this->firstName = $survey->getParameterFirstName();
        $this->lastName = $survey->getParameterLastName();
        $this->email = $survey->getParameterEmail();
        $this->age = $survey->getParameterAge(); 
        $this->path = "./data/" . $this->email . ".txt";
        $storage->writeInFile($this->path, $storage);
    }

    public function loadFileData(object $survey, object $storage): void
    {
        $this->email = $survey->getParameterEmail();
        $this->path = "./data/" . $this->email . ".txt";
        if (file_exists($this->path))
        {
            $this->file = fopen($this->path, "r");
            $survey->setParameterFirstName($storage->getFileSubstring());
            $survey->setParameterLastName($storage->getFileSubstring());
            $survey->setParameterEmail($storage->getFileSubstring());
            $survey->setParameterAge($storage->getFileSubstring());
            fclose($this->file);
        }
        else
        {
            echo "Error upload: no such file or directory" . PHP_EOL;
        }
    }

    private function getSubstringInFile(array $arrayStrings): void
    { 
        $this->firstName = $this->firstName ?? trim(substr($arrayStrings[0], strpos($arrayStrings[0], ':') + 1));
        $this->lastName = $this->lastName ?? trim(substr($arrayStrings[1], strpos($arrayStrings[1], ':') + 1));
        $this->age = $this->age ?? trim(substr($arrayStrings[3], strpos($arrayStrings[3], ':') + 1)); 
    }

    private function writeInFile(string $path, object $storage): void
    {
        if (file_exists($path))
        {
            $this->file = fopen($path, "r");
            $storage->getSubstringInFile(file($path));
            fclose($this->file);
        }
        $this->file = fopen($path, "w");
        $this->content = "First Name:" . $this->firstName . PHP_EOL . "Last Name:" . $this->lastName . PHP_EOL . "Email:" . $this->email . PHP_EOL . "Age:" . $this->age;
        fwrite($this->file, $this->content);
        fclose($this->file);
    }

    private function getFileSubstring(): ?string
    {
        $this->fileString = fgets($this->file);
        return (trim(substr($this->fileString, strpos($this->fileString, ':') + 1)));
    }
}