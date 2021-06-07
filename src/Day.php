<?php
/**
 * This file is part of the Calendar package.
 *
 * PHP version 8
 *
 * @category PHP
 * @package  Calendar
 * @author   Rafael Paulino <rafaclasses@gmail.com>
 * @license  https://github.com/rafapaulino/PHP-Calendar/LICENSE BSD Licence
 * @link     https://github.com/rafapaulino/PHP-Calendar
 */

namespace Calendar;

use stdClass;

/**
 * Class Day
 *
 * @category PHP
 * @package  Calendar
 * @author   Rafael Paulino <rafaclasses@gmail.com>
 * @license  https://github.com/rafapaulino/PHP-Calendar/LICENSE BSD Licence
 * @link     https://github.com/rafapaulino/PHP-Calendar
 */
class Day
{
    /**
     * Variable with object properties for day
     *
     * @var stdClass
     */
    protected stdClass $day;

    /**
     * Day constructor.
     *
     * @param int      $year         year for month
     * @param stdClass $month        of this day
     * @param int      $day          day number
     * @param stdClass $dayOfWeek    day of week
     * @param mixed    $date         object date from carbon
     * @param bool     $currentMonth boolean for current month
     */
    public function __construct(int $year, stdClass $month, int $day, stdClass $dayOfWeek, mixed $date, bool $currentMonth = true)
    {
        $object = new stdClass();
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
     * Return day object for calendar array
     *
     * @return stdClass
     */
    public function getDay(): stdClass
    {
        return $this->day;
    }

    /**
     * Create day object for calendar
     * 
     * @param stdClass $day day object in calendar
     * 
     * @return Day
     */
    public function setDay(stdClass $day): Day
    {
        $this->day = $day;
        return $this;
    }
}