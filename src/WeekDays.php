<?php
/**
 * WeekDays - show only days of week (header-style) following Calendar model
 */

namespace Calendar;

use Illuminate\Support\Collection;
use stdClass;
use Carbon\Carbon;

class WeekDays implements CalendarInterface
{
    protected DaysWeek $week;
    protected Collection $days;
    protected stdClass $month;
    protected int $year;
    protected Carbon $selected;

    /**
     * WeekDays constructor.
     *
     * @param int $firstDayWeek (0-6)
     * @param \DateTimeInterface|null $date optional date to center the week
     */
    public function __construct(int $firstDayWeek = 0, ?\DateTimeInterface $date = null)
    {
        $this->week = new DaysWeek();
        if ($firstDayWeek > 0) {
            $this->week->setFirst($firstDayWeek);
        }

        $this->selected = $date ? Carbon::instance($date) : Carbon::now();

        $this->setMonthAndYear();
        $this->setDays();
    }

    /**
     * Allow changing the selected start date after construction.
     *
     * @param \DateTimeInterface $date
     * @return $this
     */
    public function setSelectedDate(\DateTimeInterface $date): self
    {
        $this->selected = Carbon::instance($date);
        $this->setMonthAndYear();
        $this->setDays();
        return $this;
    }

    protected function setMonthAndYear(): void
    {
        $months = new Months();
        $array = $months->getMonths()->all();
        $this->month = $array[$this->selected->month];
        $this->year = $this->selected->year;
    }

    public function getDaysWeek(): array
    {
        return $this->week->getDays()->all();
    }

    public function getMonth(): stdClass
    {
        return $this->month;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getDays(): Collection
    {
        return $this->days;
    }

    /**
     * Build the 7-day week containing the selected date, respecting first day of week.
     */
    protected function setDays(): void
    {
        $months = new Months();
        $monthsArr = $months->getMonths()->all();

        // determine the index of the first day according to DaysWeek order
        $first = $this->week->getDays()->first()->index;

        $currentIndex = $this->selected->dayOfWeek; // 0-6
        $offset = ($currentIndex - $first + 7) % 7;

        $start = $this->selected->copy()->subDays($offset)->startOfDay();

        $items = [];

        for ($i = 0; $i < 7; $i++) {
            $d = $start->copy()->addDays($i);

            $dayOfWeek = $this->week->getDays()->firstWhere('index', $d->dayOfWeek);

            $obj = new stdClass();
            $obj->year = $d->year;
            $obj->month = $monthsArr[$d->month];
            $obj->day = (int) $d->format('d');
            $obj->dayOfWeek = $dayOfWeek;
            $obj->date = $d->format('Y-m-d');
            $obj->carbon = $d;
            $obj->currentMonth = ($d->month === $this->month->number);

            $items[] = $obj;
        }

        $this->days = new Collection($items);
    }
}
