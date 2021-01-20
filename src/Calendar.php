<?php 

namespace Calendar;

use Tightenco\Collect\Support\Collection;
use Carbon\Carbon;


class Calendar implements CalendarInterface
{
    protected $date, $week, $month, $year, $start, $end;

    public function __construct(int $month, int $year, int $firstDayWeek = 0)
    {
        $this->week = new DaysWeek;
        //set first day of week
        if ($firstDayWeek > 0 && in_array($firstDayWeek, range(0,6))) {
            $this->week->setFirst($firstDayWeek);
        }

        $this->setMonth($month);
        $this->setYear($year);
        $this->setDate();
        $this->setStart();
        $this->setEnd();
    }

    protected function setMonth(int $month): void
    {
        $months = new Months;
        $array_months = $months->getMonths()->all();

        if (!in_array($month, range(1,12)))
        $month = 1;

        $this->month = $array_months[$month];
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    protected function setYear(int $year): void
    {
        if (checkdate(1,1,$year))
        $year = date("Y");
        
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    protected function setDate(): void
    {
        $year = $this->getYear();
        $month = $this->getMonth();
        $this->date = Carbon::createFromDate($year, $month->number, 1);
    }

    /**
     * @return mixed
     */
    public function getDaysWeek()
    {
        return $this->week->getDays()->all();
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart(): void
    {
        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayWeek = $this->date->dayOfWeek;

        //get days before this month
        if ($dayWeek > 0) {
            $start = $this->date->copy()->subDays($dayWeek);
        } else {
            $start = $this->date;
        }
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd(): void
    {
        $end = $this->date->endOfMonth();
        // What is the index value (0-6) of the last day of the
        // month in question.
        $dayWeek = $end->dayOfWeek;

        //get days before this month
        if ($dayWeek < 6) {
            $days = intval(6 - $dayWeek);
            $end = $end->copy()->addDays($days);
        }

        $this->end = $end;
    }


    public function getDays()
    {
        //get first day in calendar
        $start = $this->getStart();
        //var_dump($start);

        //get last day in calendar
        $end = $this->getEnd();
        //var_dump($end);

        //criar o range de datas para o calendario
        /*
         * https://icalendario.br.com/
         * https://carbon.nesbot.com/docs/#api-period
         * http://php.net/manual/en/class.dateperiod.php
         * em cada loop voce gera um objeto de data com uma outra classe chamada Day
         * talvez você possa gerar algo como uma semana no mesmo esquema
         *
         *
         */

    }

    /*
    protected function day(int $day, int $weekday, $currentMonth = true)
    {
        $month = $this->getMonth();
        $year = $this->getYear();
        
        $obj = new \stdClass();
        $obj->day = $day;
        $obj->weekday = $weekday;
        $obj->month = $month;
        $obj->year = $year;
        $obj->date = Carbon::createFromDate($year, $month->number, $day);
        $obj->currentMonth = $currentMonth;

        return $obj;

    }*/
}