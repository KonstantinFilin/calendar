<?php

namespace Kfilin\Calendar;

class Month
{
    protected $year;
    protected $month;

    public static function createFromPeriod($period)
    {
        if (strlen($period) != 6) {
            throw new \InvalidArgumentException("Period must be 6 chars long: " . $period);
        }

        $y = substr($period, 0, 4);
        $m = substr($period, -2);

        return new self($y, $m);
    }

    public static function createFromDt($dt)
    {
        list($y, $m, ) = explode('-', $dt, 3);
        return new self($y, $m);
    }

    function __construct($year = 0, $month = 0) {

        if (!$year) {
            $year = date("Y");
        }

        if (!$month) {
            $month = date("m");
        }

        $this->year = intval($year);
        $this->month = intval($month);

        if ($month > 12 || $month < 1) {
            throw new \InvalidArgumentException("Month must be between 1 and 12 [current: " . $month . "]");
        }
    }

    public function getFullFromDayNum($dayNum)
    {
        $dayNumInt = intval($dayNum);

        return $this->getYear() . "-" . $this->getMonth() . "-" . ( $dayNumInt < 10 ? "0" . $dayNumInt : $dayNumInt );
    }

    public function isMonday($dayNum)
    {
        return $this->getWeekdayNum($dayNum) == 1;
    }

    public function isTuesday($dayNum)
    {
        return $this->getWeekdayNum($dayNum) == 2;
    }

    public function isWednesday($dayNum)
    {
        return $this->getWeekdayNum($dayNum) == 3;
    }

    public function isThursday($dayNum)
    {
        return $this->getWeekdayNum($dayNum) == 4;
    }

    public function isFriday($dayNum)
    {
        return $this->getWeekdayNum($dayNum) == 5;
    }

    public function isSaturday($dayNum)
    {
        return $this->getWeekdayNum($dayNum) == 6;
    }

    public function isSunday($dayNum)
    {
        return $this->getWeekdayNum($dayNum) == 7;
    }

    public function getWeekdayName($dayNum)
    {
        $weekdayNum = $this->getWeekdayNum($dayNum);
        $weekdayNames = $this->getWeekdayNames();

        return $weekdayNames[$weekdayNum];
    }

    public function getWeekdayNameShort($dayNum)
    {
        $weekdayNum = $this->getWeekdayNum($dayNum);
        $weekdayNames = $this->getWeekdayNamesShort();

        return $weekdayNames[$weekdayNum];
    }

    public function getWeekdayNames()
    {
        return [
            1 => "Monday",
            2 => "Tuesday",
            3 => "Wednesday",
            4 => "Thursday",
            5 => "Friday",
            6 => "Saturday",
            7 => "Sunday",
        ];
    }

    public function getWeekdayNamesShort()
    {
        return [
            1 => "Mo",
            2 => "Tu",
            3 => "We",
            4 => "Th",
            5 => "Fr",
            6 => "Sa",
            7 => "Su",
        ];
    }

    public function getMonthNames()
    {
        return [
            1 => "January",
            2 => "February",
            3 => "March",
            4 => "April",
            5 => "May",
            6 => "June",
            7 => "July",
            8 => "August",
            9 => "September",
            10 => "October",
            11 => "November",
            12 => "December",
        ];
    }

    public function getWeekdayNum($day)
    {
        $curDt = sprintf(
            "%u-%u-%u",
            $this->year,
            $this->month,
            $day
        );
        $dt = new \DateTime($curDt);
        return $dt->format("N");
    }

    public function getWeekdayNumList()
    {
        $ret = [];
        $maxDay = $this->getMaxDay();

        for($day=1; $day<= $maxDay; $day++) {
            $ret[$day] = $this->getWeekdayNum($day);
        }

        return $ret;
    }

    public function getMinDt()
    {
        return $this->getYear() . "-" . $this->getMonth() . "-01";
    }

    public function getMaxDt()
    {
        return $this->getYear() . "-" . $this->getMonth() . "-" . $this->getMaxDay();
    }

    public function getMaxDay()
    {
        $ret = [
            1 => 31,
            2 => 28,
            3 => 31,
            4 => 30,
            5 => 31,
            6 => 30,
            7 => 31,
            8 => 31,
            9 => 30,
            10 => 31,
            11 => 30,
            12 => 31
        ];

        if ($this->year%400 == 0 || ($this->year%4 == 0 && $this->year%100 !== 0)) {
            $ret[2] = 29;
        }

        return $ret[$this->month];
    }

    public function isPast()
    {
        $curY = intval(date("Y"));
        $curM = intval(date("m"));

        return $curY > $this->year || ($curY == $this->year && $curM > $this->month);
    }

    public function isFuture()
    {
        $curY = intval(date("Y"));
        $curM = intval(date("m"));

        return $curY < $this->year || ($curY == $this->year && $curM < $this->month);
    }

    public function isCurrent()
    {
        $curY = intval(date("Y"));
        $curM = intval(date("m"));

        return $this->year == $curY && $this->month == $curM;
    }

    public function getName()
    {
        $monthNames = $this->getMonthNames();
        $monthName = isset($monthNames[$this->month]) ? $monthNames[$this->month] : "???";
        return $monthName . " " . $this->year;
    }

    public function getNameShort()
    {
        $monthNames = $this->getMonthNames();
        $monthName = isset($monthNames[$this->month]) ? $monthNames[$this->month] : "???";
        return mb_substr($monthName, 0, 3) . " " . $this->year;
    }

    public function getPrev()
    {
        return $this->getPrevMonth();
    }

    public function getPrevMonth()
    {
        $m = $this->month;
        $y = $this->year;

        if ($m == 1) {
            $m = 12;
            $y--;
        } else {
            $m--;
        }

        if ($m < 10) {
            $m = "0" . $m;
        }

        return new self($y, $m);
    }

    public function getNext()
    {
        return $this->getNextMonth();
    }

    public function getNextMonth()
    {
        $m = $this->month;
        $y = $this->year;

        if ($m == 12) {
            $m = 1;
            $y++;
        } else {
            $m++;
        }

        if ($m < 10) {
            $m = "0" . $m;
        }

        return new self($y, $m);
    }

    public function __toString()
    {
        return $this->getYear() . $this->getMonth();
    }

    public function getYear() {
        return $this->year;
    }

    public function getMonth() {
        return $this->month < 10 ? "0" . $this->month : $this->month;
    }

    public function hasDt($dt)
    {
        $monthOth = self::createFromDt($dt);
        return $this->getYear() == $monthOth->getYear() && $this->getMonth() == $monthOth->getMonth();
    }
}
