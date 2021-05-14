<?php 

namespace Calendar;

use Tightenco\Collect\Support\Collection;
use Carbon\Carbon;

class Calendar implements CalendarInterface
{
    protected $date, $week, $month, $year, $start, $end, $days;

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
        $this->setStart($firstDayWeek);
        $this->setEnd($firstDayWeek);
        $this->setDays();
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
    public function setStart($firstDayWeek): void
    {
        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayWeek = $this->date->dayOfWeek;

        //sets the date to the first day of the week
        if ($dayWeek == $firstDayWeek) {
            $dayWeek = 0;
        } else if ($dayWeek > $firstDayWeek) {
            $dayWeek = $dayWeek - $firstDayWeek;
        } else {
            $dayWeek = 7 - $firstDayWeek;
        }

        //get days before this month
        if ($dayWeek > 0) {
            $start = $this->date->copy()->subDays($dayWeek);
        } else {
            $start = $this->date;
        }
        $this->start = $start->format('Y-m-d');
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
    public function setEnd($firstDayWeek): void
    {
        $end = $this->date->endOfMonth();
        // What is the index value (0-6) of the last day of the
        // month in question.
        $dayWeek = $end->dayOfWeek;

        //get days before this month
        if ($dayWeek < 6 && $firstDayWeek == 0) {
            $days = intval(6 - $dayWeek);
            $end = $end->copy()->addDays($days);
        } else if ($dayWeek > 0 && $firstDayWeek >= 1) {
            $days = 7 - $dayWeek;
            $end = $end->copy()->addDays($days);
        }

        $this->end = $end->format('Y-m-d');
    }


    public function setDays(): void
    {
        //get first day in calendar
        $start = $this->getStart();

        //get last day in calendar
        $end = $this->getEnd();

        $month = $this->getMonth();
        $year = $this->getYear();

        $days = array();
        $loop = 0;

        //create period
        $period = Carbon::parse($start)->toPeriod($end, '1 day');
        foreach ($period as $date)
        {
            $currentMonth = (($date->format('m') == $month->number) ? true:false);
            $dayOfWeek = $this->setDayOfWeek($date->dayOfWeek);

            $day = new Day(
                $year,
                $month,
                $date->format('d'),
                $dayOfWeek,
                $date,
                $currentMonth
            );
            $days[$loop] = $day->getDay();
            
            $loop++;
        }

        $this->days = new Collection($days);
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

    protected function setDayOfWeek(int $dayOfWeek)
    {
        if (!in_array($dayOfWeek, range(0,6)))
            $dayOfWeek = 0;

        foreach ($this->getDaysWeek() as $current)
        {
            if ($current->index == $dayOfWeek)
                return $current;
        }
    }
}