<?php

namespace Tymeshift\PhpTest\Domains\Schedule;

class ScheduleItemEntity implements ScheduleItemInterface
{
    private int $scheduleId;

    private string $type;

    private int $startTime;

    private int $endTime;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getScheduleId(): int
    {
        return $this->scheduleId;
    }

    public function setScheduleId(int $scheduleId): self
    {
        $this->scheduleId = $scheduleId;
        return $this;
    }

    public function getStartTime(): int
    {
        return $this->startTime;
    }

    public function setStartTime(int $startTime): ScheduleItemEntity
    {
        $this->startTime = $startTime;
        return $this;
    }

    public function getEndTime(): int
    {
        return $this->endTime;
    }

    public function setEndTime(int $endTime): ScheduleItemEntity
    {
        $this->endTime = $endTime;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): ScheduleItemEntity
    {
        $this->type = $type;
        return $this;
    }
}