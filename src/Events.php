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

use Tightenco\Collect\Support\Collection;
use Carbon\Carbon;


class Events extends Calendar
{
    protected array $events;

    public function __construct(int $month, int $year, int $firstDayWeek = 0, bool $full = true)
    {
        parent::__construct($month, $year, $firstDayWeek, $full);
        $this->events = array();
    }

    public function addEvent(string $event, string $date, int $days = 1)
    {
        if ($days > 1) {
            $end = Carbon::createFromFormat('Y-m-d', $date)->addDays($days)->toDate();
            $period = Carbon::parse($date)->toPeriod($end, '1 day');

            foreach ($period as $date) {
                $this->prependEvent($date->toDateString(),$event);
            }

        } else {
            $this->prependEvent($date,$event);
        }
    }

    protected function prependEvent($date,$event)
    {
        if (array_key_exists($date,$this->events)) {
            array_push($this->events[$date], $event);
        } else {
            $this->events[$date] = [$event];
        }
    }
}