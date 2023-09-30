<?php
declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use http\Exception;
use Tymeshift\PhpTest\Components\HttpClientInterface;
use Tymeshift\PhpTest\Exceptions\InvalidCollectionDataProvidedException;
use Tymeshift\PhpTest\Interfaces\EntityInterface;
use Tymeshift\PhpTest\Interfaces\RepositoryInterface;
use function PHPUnit\Framework\throwException;

class TaskRepository implements RepositoryInterface
{
    public function __construct(
        private TaskStorage $storage,
        private TaskFactory $factory,
    ) {
    }

    /**
     * @param int $id
     * @return EntityInterface
     */
    public function getById(int $id): TaskEntity
    {
        return $this->factory->createEntity($this->storage->getById($id));
    }

    /**
     * @param int $scheduleId
     * @return TaskCollection
     * @throws InvalidCollectionDataProvidedException
     */
    public function getByScheduleId(int $scheduleId): TaskCollection
    {
        $data = $this->factory->createCollection($this->storage->getByScheduleId($scheduleId));
        if (count($data) == 0) throw new \Exception('Empty result Exception message');
        return $data;
    }

    /**
     * @param array $ids
     * @return TaskCollection
     * @throws InvalidCollectionDataProvidedException
     */
    public function getByIds(array $ids): TaskCollection
    {
        return $this->factory->createCollection($this->storage->getByIds($ids));
    }
}