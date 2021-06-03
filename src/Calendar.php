<?php 

namespace Calendar;

use phpDocumentor\Reflection\Types\Boolean;
use Tightenco\Collect\Support\Collection;
use Carbon\Carbon;

class Calendar implements CalendarInterface
{
    const CALENDAR_MAX_DAYS = 41;

    protected $date, $week, $month, $year, $start, $end, $days;

    public function __construct(int $month, int $year, int $firstDayWeek = 0, bool $full = true)
    {    
        if (!in_array($month, range(1, 12))) {  
            throw new \InvalidArgumentException('The month must have a value between 1 and 12');
        }

        if (!checkdate(1, 1, $year)) {  
            throw new \InvalidArgumentException('The year attribute needs a valid value');
        }     
        
        if (!in_array($firstDayWeek, range(0, 6))) {  
            throw new \InvalidArgumentException('The first day of week must have a value between 0 and 6');
        }

        $this->week = new DaysWeek;
        
        //set first day of week
        if ($firstDayWeek > 0) {
            $this->week->setFirst($firstDayWeek);
        }

        $this->setMonth($month);
        $this->setYear($year);
        $this->setDate();
        $this->setStart();
        $this->setEnd($full);
        $this->setDays();
    }

    protected function setMonth(int $month): void
    {
        $months = new Months;
        $array_months = $months->getMonths()->all();

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
        $firstDayWeek = $this->week->getDays()->first();

        if ($dayWeek == $firstDayWeek->index) {
            $start = $this->date;
        } else {
            $start = $this->date->copy()->previous($firstDayWeek->name);
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
    public function setEnd($full): void
    {
        $lastDayWeek = $this->week->getDays()->last();
        $end = $this->date->endOfMonth();
        // What is the index value (0-6) of the last day of the
        // month in question.
        $dayWeek = $end->dayOfWeek;

        if ($full) {
            $start = Carbon::createFromDate($this->getStart());
            $difference = $start->diffInDays($end);
            $days = Calendar::CALENDAR_MAX_DAYS - $difference;
            $end = $end->copy()->addDays($days);
        } else {
            if ($dayWeek == $lastDayWeek->index) {
                $end = $this->date;
            } else {
                $end = $this->date->copy()->next($lastDayWeek->name);
            }
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
            $currentMonth = $date->format('m') == $month->number;
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
        foreach ($this->getDaysWeek() as $current)
        {
            if ($current->index == $dayOfWeek) {
                return $current;
            }
        }
    }
}
