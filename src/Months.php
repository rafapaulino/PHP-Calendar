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

use JetBrains\PhpStorm\Pure;
use stdClass;
use Tightenco\Collect\Support\Collection;
use DateTime;
use IntlDateFormatter;
use Calendar\Traits\ResolvesLocale;

/**
 * Class Months
 *
 * @category PHP
 * @package  Calendar
 * @author   Rafael Paulino <rafaclasses@gmail.com>
 * @license  https://github.com/rafapaulino/PHP-Calendar/LICENSE BSD Licence
 * @link     https://github.com/rafapaulino/PHP-Calendar
 */
class Months
{
    use ResolvesLocale;

    /**
     * Variable with month collection
     *
     * @var Collection
     */
    protected Collection $months;

    /**
     * Locale used to format days
     * @param string $locale
     * @var string
     */
    protected string $locale;

    /**
     * Months constructor.
     *
     * @return self
     */
    public function __construct()
    {
        $this->locale = $this->resolveLocale();
        $this->setMonths();

        return $this;
    }

    /**
     * Get the value of months
     *
     * @return Collection
     */ 
    public function getMonths(): Collection
    {
        return $this->months;
    }

    /**
     * Set the value of months
     *
     * @return self
     */ 
    protected function setMonths(): Months
    {
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = $this->makeMonth($i);
        }

        $this->months = new Collection($months);

        return $this;
    }

    /**
     * Create month object based on month number
     *
     * @param int $month
     * 
     * @return stdClass
     */
    #[Pure] protected function makeMonth(int $month): stdClass
    {
        // Usamos um ano fixo só para gerar o nome
        $date = new DateTime("2024-{$month}-01");

        $fullFormatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            null,
            'MMMM'
        );

        $shortFormatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            null,
            'MMM'
        );

        $full = ucfirst($fullFormatter->format($date));
        $short = ucfirst($shortFormatter->format($date));

        $obj = new stdClass();
        $obj->letter = mb_strtoupper(mb_substr($full, 0, 1));
        $obj->shortName = $short;
        $obj->fullName = $full;
        $obj->number = $month;

        return $obj;
    }
}