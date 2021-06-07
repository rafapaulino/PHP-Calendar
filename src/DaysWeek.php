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

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use stdClass;
use Tightenco\Collect\Support\Collection;

/**
 * Class DaysWeek
 *
 * @category PHP
 * @package  Calendar
 * @author   Rafael Paulino <rafaclasses@gmail.com>
 * @license  https://github.com/rafapaulino/PHP-Calendar/LICENSE BSD Licence
 * @link     https://github.com/rafapaulino/PHP-Calendar
 */
class DaysWeek
{
    /**
     * Variable with days of week collection
     *
     * @var Collection
     */
    protected Collection $days;

    /**
     * DaysWeek constructor.
     *
     * @return self
     */
    public function __construct()
    {
        $this->setDays();

        return $this;
    }

    /**
     * Get the value of days
     *
     * @return Collection
     */ 
    public function getDays(): Collection
    {
        return $this->days;
    }

    /**
     * Set the value of days
     *
     * @return self
     */ 
    protected function setDays(): DaysWeek
    {
        $this->days = new Collection(
            [
            0 => $this->sunday(),
            1 => $this->monday(),
            2 => $this->tuesday(),
            3 => $this->wednesday(),
            4 => $this->thursday(),
            5 => $this->friday(),
            6 => $this->saturday()
            ]
        );

        return $this;
    }

    /**
     * Format sunday in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function sunday(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("S");
        $obj->shortName = _("Sun");
        $obj->fullName = _("Sunday");
        $obj->name = "Sunday";
        $obj->index = 0;
        return $obj;
    }

    /**
     * Format monday in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function monday(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("M");
        $obj->shortName = _("Mon");
        $obj->fullName = _("Monday");
        $obj->name = "Monday";
        $obj->index = 1;
        return $obj;
    }

    /**
     * Format tuesday in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function tuesday(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("T");
        $obj->shortName = _("Tue");
        $obj->fullName = _("Tuesday");
        $obj->name = "Tuesday";
        $obj->index = 2;
        return $obj;
    }

    /**
     * Format wednesday in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function wednesday(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("W");
        $obj->shortName = _("Wed");
        $obj->fullName = _("Wednesday");
        $obj->name = "Wednesday";
        $obj->index = 3;
        return $obj;
    }

    /**
     * Format thursday in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function thursday(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("T");
        $obj->shortName = _("Thu");
        $obj->fullName = _("Thursday");
        $obj->name = "Thursday";
        $obj->index = 4;
        return $obj;
    }

    /**
     * Format friday in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function friday(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("F");
        $obj->shortName = _("Fri");
        $obj->fullName = _("Friday");
        $obj->name = "Friday";
        $obj->index = 5;
        return $obj;
    }

    /**
     * Format saturday in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function saturday(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("S");
        $obj->shortName = _("Sat");
        $obj->fullName = _("Saturday");
        $obj->name = "Saturday";
        $obj->index = 6;
        return $obj;
    }

    /**
     * Set the first day of week between 0-6
     *
     * @param int $key first day of week
     *
     * @return $this
     */
    public function setFirst(int $key = 1): DaysWeek
    {
        if (!in_array($key, range(0, 6))) {
            throw new InvalidArgumentException('The first day of week must have a value between 0 and 6');
        }

        if ($key > 0) {
            $original = $this->days;
            $slice = $original->slice($key);
            $remainder = $original->slice(0, $key);

            $days = array();

            foreach ($slice->all() as $key => $value) {
                $days[$key] = $value;
            }

            foreach ($remainder->all() as $key => $value) {
                $days[$key] = $value;
            }

            $this->days = new Collection($days);
        }
        return $this;
    }
}