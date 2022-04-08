<?php

namespace App\Controller;

use App\Module\Greetings\PersonGreetings;
use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\Survey;
use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\SurveyPrinter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends AbstractController
{
//    public function saveSurvey(Request $request): Response
//    {
//        $greetings = new PersonGreetings();
//
//        $name = $request->get('name');
//        $preparedName = $greetings->prepareAppeal($name);
//        return $this->render('greetings.html.twig', ['name' => $preparedName]);
//    }
    private ?object $request;
    private ?object $storage;
    private ?object $survey;

    public function CreateSurvey(Request $request): Response
    {
        $this->request = new RequestSurveyLoader;
        $this->storage = new SurveyFileStorage;
        $this->survey = $this->request->createNewSurvey('first_name', 'last_name', 'email', 'age');
        if ($this->survey)
        {
            echo "Loading old data from file:" . PHP_EOL . PHP_EOL;
            $this->storage->loadFileData($this->survey, $this->storage);
            SurveyPrinter::printSurvey($this->survey);

            echo PHP_EOL . "Writing new parameters to file:" . PHP_EOL . PHP_EOL;
            $this->survey = $this->request->createNewSurvey('first_name', 'last_name', 'email', 'age');
            if ($this->survey)
            {
                $this->storage->saveData($this->survey, $this->storage);
                $this->storage->loadFileData($this->survey, $this->storage);
                SurveyPrinter::printSurvey($this->survey);
            }
        }
        return $this->render('CreatingSurvey.html.twig', ['name' => 'Done']);
    }
}
/*
require_once("src/common.inc.php");
$request = new RequestSurveyLoader;
$storage = new SurveyFileStorage;
$survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age'); 
if ($survey)
{
    echo "Loading old data from file:" . PHP_EOL . PHP_EOL;
    $storage->loadFileData($survey, $storage);
    SurveyPrinter::printSurvey($survey);

    echo PHP_EOL . "Writing new parameters to file:" . PHP_EOL . PHP_EOL;
    $survey = $request->createNewSurvey('first_name', 'last_name', 'email', 'age'); 
    if ($survey)
    {
        $storage->saveData($survey, $storage);
        $storage->loadFileData($survey, $storage);
        SurveyPrinter::printSurvey($survey);
    }
}
*/