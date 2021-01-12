<?php

namespace Kfilin\Calendar\ru;

class Month extends \kfilin\Calendar\Month
{
    public function getWeekdayNamesShort()
    {
        return [
            1 => "Пн",
            2 => "Вт",
            3 => "Ср",
            4 => "Чт",
            5 => "Пт",
            6 => "Сб",
            7 => "Вс",
        ];
    }

    public function getWeekdayNames()
    {
        return [
            1 => "Понедельник",
            2 => "Вторник",
            3 => "Среда",
            4 => "Четверг",
            5 => "Пятница",
            6 => "Суббота",
            7 => "Воскресенье",
        ];
    }

    public function getMonthNames()
    {
        return [
            1 => "Январь",
            2 => "Февраль",
            3 => "Март",
            4 => "Апрель",
            5 => "Май",
            6 => "Июнь",
            7 => "Июль",
            8 => "Август",
            9 => "Сентябрь",
            10 => "Октябрь",
            11 => "Ноябрь",
            12 => "Декабрь",
        ];
    }
}
