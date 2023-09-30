<?php

namespace Tymeshift\PhpTest\Domains\Schedule;

use Tymeshift\PhpTest\Domains\Task\TaskRepository;
use Tymeshift\PhpTest\Exceptions\InvalidCollectionDataProvidedException;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;
use Tymeshift\PhpTest\Interfaces\EntityInterface;

class ScheduleService implements ScheduleServiceInterface
{
    public function __construct(
        private TaskRepository $taskRepository,
        private ScheduleRepository $scheduleRepository
    ) {
    }

    /**
     * Add items to schedule entity
     * @param int $scheduleId
     * @return ScheduleEntityInterface
     * @throws InvalidCollectionDataProvidedException
     * @throws StorageDataMissingException
     */
    public function addScheduleItems(int $scheduleId): ScheduleEntityInterface
    {
        $schedule = $this->scheduleRepository->getById($scheduleId);
        $tasks = $this->taskRepository->getByScheduleId($scheduleId);

        $scheduleItems = [];
        foreach ($tasks as $task) {
            $scheduleItem = new ScheduleItemEntity();
            $scheduleItem->setScheduleId($task->getScheduleId());
            $scheduleItem->setStartTime($task->getStartTime()->getTimestamp());
            $scheduleItem->setEndTime($task->getStartTime()->getTimestamp() + $task->getDuration());
            $scheduleItem->setType('type');
            $scheduleItems[] = $scheduleItem;
        }
        $schedule->setItems($scheduleItems);
        return $schedule;

    }

}