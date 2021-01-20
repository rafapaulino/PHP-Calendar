<?php 

namespace Calendar;

use Tightenco\Collect\Support\Collection;
use Calendar\DaysWeek;
use Calendar\Months;

class Calendar implements CalendarInterface
{
    protected $week, $month, $year, $firstDayMonth, $numberDays, $dayOfWeek;

    public function __construct(int $month, int $year)
    {
        $this->week = new DaysWeek;
        $this->setMonth($month);
        $this->setYear($year);
        $this->setFirstDayMonth();
        $this->setNumberDays();
        $this->setDayOfWeek();
    }

    public function getDaysWeek()
    {
        return $this->week->getDays()->all();
    }

    protected function setMonth(int $month)
    {
        $months = new Months;
        $array_months = $months->getMonths()->all();

        if (!in_array($month, range(1,12)))
        $month = 1;

        $this->month = $array_months[$month];
    }

    public function getMonth()
    {
        return $this->month;
    }

    protected function setYear(int $year)
    {
        if (checkdate(1,1,$year)) {
            $year = date("Y");
        }
        $this->year = $year;
    }

    public function getYear()
    {
        return $this->year;
    }

    protected function setFirstDayMonth()
    {
        $month = $this->getMonth();
        // What is the first day of the month in question?
        $this->firstDayMonth = mktime(0,0,0,$month->number,1,$this->getYear());
    }

    public function getFirstDayMonth()
    {
        return $this->firstDayMonth;
    }

    /**
     * @return mixed
     */
    public function getNumberDays()
    {
        return $this->numberDays;
    }

    protected function setNumberDays(): void
    {
        // How many days does this month contain?
        $numberDays = date('t',$this->getFirstDayMonth());
        $this->numberDays = $numberDays;
    }

    /**
     * @return mixed
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek(): void
    {
        // Retrieve some information about the first day of the
        // month in question.
        $date = getdate($this->getFirstDayMonth());

        // What is the index value (0-6) of the first day of the
        // month in question.
        $this->dayOfWeek = $date["wday"];
    }

    public function getDays(int $number = 0)
    {
        //set first day of week
        if (in_array($number, range(0,6))) {
            $this->week->setFirst($number);
        }

        //get month
        $month = $this->getMonth();

        //get year
        $year = $this->getYear();

        //get all days of week with name, letter and shortname
        $week = $this->getDaysWeek();

        //get first day of Month
        $first = $this->getFirstDayMonth();

        //I take the total days of this month
        $numberDays = $this->getNumberDays();

        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayOfWeek = $this->getDayOfWeek();


    }
}