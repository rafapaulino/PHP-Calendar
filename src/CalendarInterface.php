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
use Tightenco\Collect\Support\Collection;

/**
 * Mandatory methods to create a calendar
 *
 * @category PHP
 * Interface CalendarInterface
 * @package  Calendar
 * @author   Rafael Paulino <rafaclasses@gmail.com>
 * @license  https://github.com/rafapaulino/PHP-Calendar/LICENSE BSD Licence
 * @link     https://github.com/rafapaulino/PHP-Calendar
 */
interface CalendarInterface
{
    /**
     * Return days of week 
     * 
     * @return array
     */
    public function getDaysWeek(): array;

    /**
     * Return the month for this calendar
     * 
     * @return stdClass
     */
    public function getMonth(): stdClass;

    /**
     * Return the year for this calendar
     * 
     * @return int
     */
    public function getYear(): int;

    /**
     * Return a Collection with all days in calendar
     * 
     * @return Collection
     */
    public function getDays(): Collection;

}