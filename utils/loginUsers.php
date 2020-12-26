<?php


use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('./../secret/horarios-7b345-c3fcfbc451d2.json');


$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    //si no funca lo de arriba usar esto:
    //->withDatabaseUri('https://lab2-sotr.firebaseio.com/')
    ->create();

$database = $firebase->getDatabase();



?>