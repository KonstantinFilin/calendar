<?php

namespace Kfilin\Calendar;

class Date
{
    protected $day;
    protected $month;
    protected $year;

    function __construct($year, $month, $day ) {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    public function getWeekdayNum()
    {
        $dtObj = $this->getAsPhpObject();

        return $dtObj->format("N");
    }

    public function getPrev($days = 1)
    {
        $dtObj = new \DateTime((string) $this);
        $dtObj->sub(new \DateInterval("P" . $days . "D"));
        return $dtObj->format("Y-m-d");
    }

    public function getNext($days = 1)
    {
        $dtObj = new \DateTime((string) $this);
        $dtObj->add(new \DateInterval("P" . $days . "D"));
        return $dtObj->format("Y-m-d");
    }

    public function getAsArray()
    {
        return [
            $this->year,
            $this->month,
            $this->day
        ];
    }

    public function getAsPhpObject()
    {
        return new \DateTime((string) $this);
    }

    public function __toString() {
        return $this->year . "-" . $this->month . "-" . $this->day;
    }

    public static function createFromString($date)
    {
        list($year, $month, $day) = explode("-", $date);

        return new self($year, $month, $day);
    }
}
