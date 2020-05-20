<?php

function getBoxes()
{

    return array("This midterm was easy", "I like midterms", "Today is monday");
}

function validName($string)
{
    global$f3;
    $f3->get('firstName');
    return !empty(($string) && ctype_alpha($string));
}

function validArray($box)
{
    global$f3;
    return in_array($box, $f3->get('boxes'));
}