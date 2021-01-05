<?php 

include 'vendor/autoload.php';

use Calendar\DaysWeek;

$days = new DaysWeek;
$semana = $days->getDays();

foreach($semana->all() as $key => $value)
{
    echo $key . '<br>';
    echo $value->letter  . '<br>';
    echo $value->shortName  . '<br>';
    echo $value->fullName  . '<br><hr>';

}