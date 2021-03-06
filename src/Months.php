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
    /**
     * Variable with month collection
     *
     * @var Collection
     */
    protected Collection $months;

    /**
     * Months constructor.
     *
     * @return self
     */
    public function __construct()
    {
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
        $this->months = new Collection(
            [
            1 => $this->january(),
            2 => $this->february(),
            3 => $this->march(),
            4 => $this->april(),
            5 => $this->may(),
            6 => $this->june(),
            7 => $this->july(),
            8 => $this->august(),
            9 => $this->september(),
            10 => $this->october(),
            11 => $this->november(),
            12 => $this->december()
            ]
        );

        return $this;
    }

    /**
     * Format january month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function january(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("J");
        $obj->shortName = _("Jan");
        $obj->fullName = _("January");
        $obj->number = 1;
        return $obj;
    }

    /**
     * Format february month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function february(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("F");
        $obj->shortName = _("Feb");
        $obj->fullName = _("February");
        $obj->number = 2;
        return $obj;
    }

    /**
     * Format march month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function march(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("M");
        $obj->shortName = _("Mar");
        $obj->fullName = _("March");
        $obj->number = 3;
        return $obj;
    }

    /**
     * Format april month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function april(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("A");
        $obj->shortName = _("Apr");
        $obj->fullName = _("April");
        $obj->number = 4;
        return $obj;
    }

    /**
     * Format may month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function may(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("M");
        $obj->shortName = _("May");
        $obj->fullName = _("May");
        $obj->number = 5;
        return $obj;
    }

    /**
     * Format june month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function june(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("J");
        $obj->shortName = _("Jun");
        $obj->fullName = _("June");
        $obj->number = 6;
        return $obj;
    }

    /**
     * Format july month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function july(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("J");
        $obj->shortName = _("Jul");
        $obj->fullName = _("July");
        $obj->number = 7;
        return $obj;
    }

    /**
     * Format august month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function august(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("A");
        $obj->shortName = _("Aug");
        $obj->fullName = _("August");
        $obj->number = 8;
        return $obj;
    }

    /**
     * Format september month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function september(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("S");
        $obj->shortName = _("Sep");
        $obj->fullName = _("September");
        $obj->number = 9;
        return $obj;
    }

    /**
     * Format october month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function october(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("O");
        $obj->shortName = _("Oct");
        $obj->fullName = _("October");
        $obj->number = 10;
        return $obj;
    }

    /**
     * Format november month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function november(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("N");
        $obj->shortName = _("Nov");
        $obj->fullName = _("November");
        $obj->number = 11;
        return $obj;
    }

    /**
     * Format december month in stdClass
     *
     * @return stdClass
     */
    #[Pure] protected function december(): stdClass
    {
        $obj = new stdClass();
        $obj->letter = _("D");
        $obj->shortName = _("Dec");
        $obj->fullName = _("December");
        $obj->number = 12;
        return $obj;
    }
}