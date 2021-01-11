<?php

namespace kfilin\Calendar;

class Period 
{
    /**
     *
     * @var Date
     */
    protected $dt1;

    /**
     *
     * @var Date
     */
    protected $dt2;
    
    function __construct(Date $dt1, Date $dt2) {
        $this->dt1 = $dt1;
        $this->dt2 = $dt2;
    }

    public static function createFromString($dt1, $dt2)
    {
        return new self(Date::createFromString($dt1), Date::createFromString($dt2));
    }
    
    public function contains($dt, $dtFrom, $dtTo) 
    {
        if (!$dt instanceof \DateTime) {
            $dt = new \DateTime($dt);
        }
        
        if (!$dt) {
            throw new \InvalidArgumentException("Invalid argument \$dt");
        }
        
        $dtFromObj = new \DateTime($dtFrom);

        if (!$dtFromObj) {
            throw new \InvalidArgumentException("Invalid argument \$dtFrom");
        }

        if ($dtFromObj > $dt) {
            return false;
        }

        if (!$dtTo) {
            return true;
        }

        $dtToObj = new \DateTime($dtTo);

        if (!$dtToObj) {
            throw new \InvalidArgumentException("Invalid argument \$dtTo");
        }

        if ($dtToObj >= $dt) {
            return true;
        }
        
        return false;
    }
}
