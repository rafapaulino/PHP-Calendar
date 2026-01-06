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
use DateTime;
use IntlDateFormatter;
use Calendar\Traits\ResolvesLocale;

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
    use ResolvesLocale;

    /**
     * Variable with days of week collection
     *
     * @var Collection
     */
    protected Collection $days;

    /**
     * Locale used to format days
     * @param string $locale
     * @var string
     */
    protected string $locale;

    /**
     * DaysWeek constructor.
     *
     * @return self
     */
    public function __construct()
    {
        $this->locale = $this->resolveLocale();
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
                0 => $this->makeDay(0),
                1 => $this->makeDay(1),
                2 => $this->makeDay(2),
                3 => $this->makeDay(3),
                4 => $this->makeDay(4),
                5 => $this->makeDay(5),
                6 => $this->makeDay(6)
            ]
        );

        return $this;
    }


    #[Pure] protected function makeDay(int $index): stdClass
    {
        // 0 = domingo
        $date = new DateTime("Sunday +{$index} days");

        $fullFormatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            null,
            'EEEE'
        );

        $shortFormatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            null,
            'EEE'
        );

        $letterFormatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            null,
            'EEEEE'
        );

        $obj = new stdClass();
        $obj->letter = mb_strtoupper($letterFormatter->format($date));
        $obj->shortName = ucfirst($shortFormatter->format($date));
        $obj->fullName = ucfirst($fullFormatter->format($date));
        $obj->name = $date->format('l'); // nome interno em inglês
        $obj->index = $index;

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