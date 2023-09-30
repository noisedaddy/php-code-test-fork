<?php
declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Schedule;

use Tymeshift\PhpTest\Interfaces\EntityInterface;

interface ScheduleItemInterface extends EntityInterface
{

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self;
    /**
     * @return int
     */
    public function getScheduleId(): int;


    /**
     * @return int
     */
    public function getStartTime(): int;

    /**
     * @return int
     */
    public function getEndTime(): int;

    /**
     * @return string
     */
    public function getType(): string;
}