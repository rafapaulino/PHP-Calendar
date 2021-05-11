<?php

namespace Calendar;

use Carbon\Carbon;

class Day
{
    protected $day;

    public function __construct(int $year, $month, int $day, $dayOfWeek, Carbon $date, $currentMonth = true)
    {
        $object = new \stdClass();
        $object->year = $year;
        $object->month = $month;
        $object->day = $day;
        $object->dayOfWeek = $dayOfWeek;
        $object->date = $date->format('Y-m-d');
        $object->carbon = $date;
        $object->currentMonth = $currentMonth;

        $this->setDay($object);
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     * @return Day
     */
    public function setDay($day)
    {
        $this->day = $day;
        return $this;
    }
}