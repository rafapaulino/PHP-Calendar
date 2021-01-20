<?php 

include 'vendor/autoload.php';

use Calendar\DaysWeek;
use Calendar\Months;
use Calendar\Calendar;

$days = new DaysWeek;
$semana = $days->getDays();

foreach($semana->all() as $key => $value)
{
    echo $key . '<br>';
    echo $value->letter  . '<br>';
    echo $value->shortName  . '<br>';
    echo $value->fullName  . '<br><hr>';

}

echo '<br><br><hr><br><br>';

$slice = $days->setFirst(1);

$semana = $days->getDays();

foreach($semana->all() as $key => $value)
{
    echo $key . '<br>';
    echo $value->letter  . '<br>';
    echo $value->shortName  . '<br>';
    echo $value->fullName  . '<br><hr>';
}

echo '<hr><br><hr><br><br>';

$months = new Months;
$m = $months->getMonths();

foreach($m->all() as $key => $value)
{
    echo $key . '<br>';
    echo $value->letter  . '<br>';
    echo $value->shortName  . '<br>';
    echo $value->fullName  . '<br><hr>';

}

echo '<hr><br><hr><br><br>';

$calendar = new Calendar(1,2020);

$month = $calendar->getMonth();
$year = $calendar->getYear();

$days = $calendar->getDays();
$week = $calendar->getDaysWeek();

echo '<pre>';
var_dump($week);
var_dump($month);
var_dump($year);
echo '</pre>';

/*
setlocale(LC_TIME, 'pt_BR.UTF-8'); 

for($m=1; $m<=12; ++$m){
    echo date('F', mktime(0, 0, 0, $m, 1)).'<br>';
}

$monthNumber = 1;
setlocale(LC_TIME, 'pt_BR.UTF-8');                                              
echo $monthName = strftime('%B', mktime(0, 0, 0, $monthNumber));
*/