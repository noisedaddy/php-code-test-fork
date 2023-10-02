<?php
declare(strict_types=1);
namespace Tests;

use Codeception\Example;
use Mockery\Mock;
use Mockery\MockInterface;
use Tymeshift\PhpTest\Components\DatabaseInterface;
use Tymeshift\PhpTest\Components\HttpClientInterface;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleRepository;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleFactory;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleService;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleStorage;
use Tymeshift\PhpTest\Domains\Task\TaskFactory;
use Tymeshift\PhpTest\Domains\Task\TaskRepository;
use Tymeshift\PhpTest\Domains\Task\TaskStorage;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;

class ScheduleServiceCest
{
    /**
     * @var MockInterface|null
     */
    private ?MockInterface $database;
    /**
     * @var MockInterface|null
     */
    private ?MockInterface $httpClientMock;
    /**
     * @var ScheduleService
     */
    private ScheduleService $scheduleService;

    public function _before(): void
    {
        $this->httpClientMock = \Mockery::mock(HttpClientInterface::class);
        $this->database = \Mockery::mock(DatabaseInterface::class);
        $this->scheduleService = new ScheduleService(
            new TaskRepository(
                new TaskStorage(
                    $this->httpClientMock
                ),
                new TaskFactory()
            ),
            new ScheduleRepository(
                new ScheduleStorage(
                    $this->database
                ),
                new ScheduleFactory()
            ),
        );
    }

    public function _after(): void
    {
        $this->httpClientMock = null;
        $this->database = null;
        \Mockery::close();
    }

    /**
     * @dataProvider tasksDataProvider
     */
    public function testFillScheduleItemsSuccess(Example $example, \UnitTester $tester): void
    {
        $data = [ 'id' => 1, 'start_time' => 1631232000, 'end_time' => 1631232000 + 86400, 'name' => 'Test' ];
        $tasks = iterator_to_array($example, true);

        $this->httpClientMock
            ->shouldReceive('request')
            ->andReturn($tasks);

        $this->database
            ->shouldReceive('query')
            ->with('SELECT * FROM schedules WHERE id=:id', ["id" => 1])
            ->andReturn($data);

        $schedule = $this->scheduleService->addScheduleItems(1);

        $tester->assertEquals($data['id'], $schedule->getId());
        $tester->assertEquals($data['name'], $schedule->getName());
        $tester->assertCount(count($tasks), $schedule->getItems()[0]);
    }

    /**
     * @return array[]
     */
    protected function tasksDataProvider(): array
    {
        return [
            [
                [ "id" => 123, "schedule_id" => 1, "start_time" => 0, "duration" => 3600 ],
                [ "id" => 431, "schedule_id" => 1, "start_time" => 3600, "duration" => 650 ],
                [ "id" => 332, "schedule_id" => 1, "start_time" => 5600, "duration" => 3600 ],
            ]
        ];
    }
}