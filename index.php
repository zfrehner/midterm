<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);



//require auto load file
require_once("vendor/autoload.php");
require_once("model/data-layer.php");

session_start();

//instantiate f3 base class (create an instance of the base class)
$f3 = Base::instance();

//define a default root (what the user sees when they go to index page)
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/home.html');

});

$f3-> route('GET|POST /survey', function($f3) {

    $_SESSION = array();
    $boxes = getBoxes();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        //Store the data in the session array
        //$_SESSION['firstName'] = $_POST['firstName'];
        //$_SESSION['boxes'] = $_POST['boxes'];

        $name = $_POST['firstName'];
        $box = $_POST['boxes'];
        if (validName($name) && validArray($box)) {
            $_SESSION['firstName'] = $name;
            $f3->reroute('/summary');
        }
        else {
            $f3->set("errors['err']", "Please fill out both questions.");
        }
    }




    $f3->set('boxes', $boxes);
    $view = new Template();
    echo $view->render('views/survey.html');

});

$f3->route('GET /summary', function(){

    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
});

//run fat free
$f3->run();
