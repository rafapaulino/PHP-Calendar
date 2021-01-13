<?php 

namespace Calendar;

use Tightenco\Collect\Support\Collection;

class DaysWeek
{
    private $days;

    public function __construct()
    {
        $this->setDays();
    }

    /**
     * Get the value of days
     */ 
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set the value of days
     *
     * @return  self
     */ 
    private function setDays()
    {
        $this->days = new Collection([
            0 => $this->sunday(),
            1 => $this->monday(),
            2 => $this->tuesday(),
            3 => $this->wednesday(),
            4 => $this->thursday(),
            5 => $this->friday(),
            6 => $this->saturday()
        ]);

        return $this;
    }

    private function sunday()
    {
        $obj = new \stdClass();
        $obj->letter = _("S");
        $obj->shortName = _("Sun");
        $obj->fullName = _("Sunday");
        return $obj;
    }

    private function monday()
    {
        $obj = new \stdClass();
        $obj->letter = _("M");
        $obj->shortName = _("Mon");
        $obj->fullName = _("Monday");
        return $obj;
    }

    private function tuesday()
    {
        $obj = new \stdClass();
        $obj->letter = _("T");
        $obj->shortName = _("Tue");
        $obj->fullName = _("Tuesday");
        return $obj;
    }

    private function wednesday()
    {
        $obj = new \stdClass();
        $obj->letter = _("W");
        $obj->shortName = _("Wed");
        $obj->fullName = _("Wednesday");
        return $obj;
    }

    private function thursday()
    {
        $obj = new \stdClass();
        $obj->letter = _("T");
        $obj->shortName = _("Thu");
        $obj->fullName = _("Thursday");
        return $obj;
    }

    private function friday()
    {
        $obj = new \stdClass();
        $obj->letter = _("F");
        $obj->shortName = _("Fri");
        $obj->fullName = _("Friday");
        return $obj;
    }

    private function saturday()
    {
        $obj = new \stdClass();
        $obj->letter = _("S");
        $obj->shortName = _("Sat");
        $obj->fullName = _("Saturday");
        return $obj;
    }

    public function setFirst(int $key = 1)
    {
        if ($key > 0) {
            $original = $this->days;
            $slice = $original->slice($key);
            $remainder = $original->slice(0,$key);

            $days = array();

            foreach($slice->all() as $key => $value)
            {
                $days[$key] = $value;
            }

            foreach($remainder->all() as $key => $value)
            {
                $days[$key] = $value;
            }

            $this->days = new Collection($days);

            return $this;
        }
    }
}