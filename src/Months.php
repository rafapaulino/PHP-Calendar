<?php 

namespace Calendar;

use Tightenco\Collect\Support\Collection;

class Months
{
    private $months;

    public function __construct()
    {
        $this->setMonths();
    }

    /**
     * Get the value of months
     */ 
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * Set the value of months
     *
     * @return  self
     */ 
    private function setMonths()
    {
        $this->months = new Collection([
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
        ]);

        return $this;
    }

    private function january()
    {
        $obj = new \stdClass();
        $obj->letter = _("J");
        $obj->shortName = _("Jan");
        $obj->fullName = _("January");
        $obj->number = 1;
        return $obj;
    }

    private function february()
    {
        $obj = new \stdClass();
        $obj->letter = _("F");
        $obj->shortName = _("Feb");
        $obj->fullName = _("February");
        $obj->number = 2;
        return $obj;
    }

    private function march()
    {
        $obj = new \stdClass();
        $obj->letter = _("M");
        $obj->shortName = _("Mar");
        $obj->fullName = _("March");
        $obj->number = 3;
        return $obj;
    }

    private function april()
    {
        $obj = new \stdClass();
        $obj->letter = _("A");
        $obj->shortName = _("Apr");
        $obj->fullName = _("April");
        $obj->number = 4;
        return $obj;
    }

    private function may()
    {
        $obj = new \stdClass();
        $obj->letter = _("M");
        $obj->shortName = _("May");
        $obj->fullName = _("May");
        $obj->number = 5;
        return $obj;
    }

    private function june()
    {
        $obj = new \stdClass();
        $obj->letter = _("J");
        $obj->shortName = _("Jun");
        $obj->fullName = _("June");
        $obj->number = 6;
        return $obj;
    }

    private function july()
    {
        $obj = new \stdClass();
        $obj->letter = _("J");
        $obj->shortName = _("Jul");
        $obj->fullName = _("July");
        $obj->number = 7;
        return $obj;
    }

    private function august()
    {
        $obj = new \stdClass();
        $obj->letter = _("A");
        $obj->shortName = _("Aug");
        $obj->fullName = _("August");
        $obj->number = 8;
        return $obj;
    }

    private function september()
    {
        $obj = new \stdClass();
        $obj->letter = _("S");
        $obj->shortName = _("Sep");
        $obj->fullName = _("September");
        $obj->number = 9;
        return $obj;
    }

    private function october()
    {
        $obj = new \stdClass();
        $obj->letter = _("O");
        $obj->shortName = _("Oct");
        $obj->fullName = _("October");
        $obj->number = 10;
        return $obj;
    }

    private function november()
    {
        $obj = new \stdClass();
        $obj->letter = _("N");
        $obj->shortName = _("Nov");
        $obj->fullName = _("November");
        $obj->number = 11;
        return $obj;
    }

    private function december()
    {
        $obj = new \stdClass();
        $obj->letter = _("D");
        $obj->shortName = _("Dec");
        $obj->fullName = _("December");
        $obj->number = 12;
        return $obj;
    }
}