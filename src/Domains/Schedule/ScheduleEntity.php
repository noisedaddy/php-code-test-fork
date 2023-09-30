<?php
declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Schedule;

use DateTime;
use Tymeshift\PhpTest\Interfaces\EntityInterface;

class ScheduleEntity implements ScheduleEntityInterface
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var DateTime
     */
    private DateTime $startTime;

    /**
     * @var DateTime
     */
    private DateTime $endTime;

    /**
     * @var ScheduleItemInterface[]
     */
    private array $items;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ScheduleEntity
     */
    public function setId(int $id): ScheduleEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ScheduleEntity
     */
    public function setName(string $name): ScheduleEntity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    /**
     * @param DateTime $startTime
     * @return ScheduleEntity
     */
    public function setStartTime(DateTime $startTime): ScheduleEntity
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndTime(): DateTime
    {
        return $this->endTime;
    }

    /**
     * @param DateTime $endTime
     * @return ScheduleEntity
     */
    public function setEndTime(DateTime $endTime): ScheduleEntity
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function setItems(array $items): self
    {
        $this->items[] = $items;

        return $this;
    }

}