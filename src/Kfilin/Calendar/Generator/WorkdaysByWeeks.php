<?php

namespace Kfilin\Calendar\Generator;

class WorkdaysByWeeks implements \kfilin\Calendar\GeneratorIf
{
    /**
     *
     * @var \kfilin\Calendar\Month
     */
    protected $month;

    /**
     *
     * @var boolean
     */
    protected $includeNeighbor;

    function __construct(\kfilin\Calendar\Month $month, $includeNeighbor) {
        $this->month = $month;
        $this->includeNeighbor = $includeNeighbor;
    }

    public function make() {

    }
}
