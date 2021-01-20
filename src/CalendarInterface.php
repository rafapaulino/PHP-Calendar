<?php 

namespace Calendar;

interface CalendarInterface
{
    public function getDaysWeek();

    public function getMonth();

    public function getYear();

    public function getDays();

}