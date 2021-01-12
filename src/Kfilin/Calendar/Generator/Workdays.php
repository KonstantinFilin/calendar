<?php

namespace Kfilin\Calendar\Generator;

class Workdays implements \GeneratorIf
{
    /**
     *
     * @var \kfilin\Calendar\Month
     */
    protected $month;

    function __construct(\kfilin\Calendar\Month $month) {
        $this->month = $month;
    }

    public function make()
    {
        $maxDay = $this->month->getMaxDay();
        $ret = [];

        for ($dayNum = 1; $dayNum <= $maxDay; $dayNum++) {
            $dt = $this->month->getFullFromDayNum($dayNum);

        }

        return $ret;
    }
}
