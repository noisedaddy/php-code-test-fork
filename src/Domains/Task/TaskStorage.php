<?php
declare(strict_types=1);

namespace Tymeshift\PhpTest\Domains\Task;

use Tymeshift\PhpTest\Components\HttpClientInterface;

class TaskStorage implements TaskStorageInterface
{

    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    /**
     * Get tasks based on schedule id
     * added local source data for testing
     * @param int $scheduledId
     * @return array
     */
    public function getByScheduleId(int $scheduledId): array
    {
        return $this->httpClient->request(
            'GET',
            'https://localhost/api/v1/tasks?schedule_id='.$scheduledId
        );

    }

    /**
     * Get tasks on ids
     * @param array $ids
     * @return array
     */
    public function getByIds(array $ids): array
    {
        return $this->httpClient->request(
            'GET',
            'http://localhost:80/api/v1/tasks?ids=[' . implode(',', $ids).']'
        );

    }

    /**
     * Get task on id
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        return $this->httpClient->request(
            'GET',
            'http://localhost:80/api/v1/tasks?id=' . $id
        );

    }

}