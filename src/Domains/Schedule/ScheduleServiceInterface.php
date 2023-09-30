<?php

namespace Tymeshift\PhpTest\Domains\Schedule;

use Tymeshift\PhpTest\Interfaces\EntityInterface;


interface ScheduleServiceInterface
{

    /**
     * @param int $scheduleId
     * @return EntityInterface
     */
    public function addScheduleItems(int $scheduleId): ScheduleEntityInterface;
}