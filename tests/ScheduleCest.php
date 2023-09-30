<?php
declare(strict_types=1);
namespace Tests;

use Codeception\Example;
use Mockery\MockInterface;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleRepository;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleFactory;
use Tymeshift\PhpTest\Domains\Schedule\ScheduleStorage;
use Tymeshift\PhpTest\Exceptions\StorageDataMissingException;

class ScheduleCest
{

    /**
     * @var MockInterface|ScheduleStorage
     */
    private $scheduleStorageMock;

    /**
     * @var ScheduleRepository
     */
    private $scheduleRepository;

    public function _before()
    {
        $this->scheduleStorageMock = \Mockery::mock(ScheduleStorage::class);
        $this->scheduleRepository = new ScheduleRepository($this->scheduleStorageMock, new ScheduleFactory());
    }

    public function _after()
    {
        $this->scheduleRepository = null;
        $this->scheduleStorageMock = null;
        \Mockery::close();
    }

    /**
     * @dataProvider schedulesProvider
     */
    public function testGetByIdSuccess(Example $example, \UnitTester $tester)
    {
        ['id' => $id, 'start_time' => $startTime, 'end_time' => $endTime, 'name' => $name] = $example;
        $data = ['id' => $id, 'start_time' => $startTime, 'end_time' => $endTime, 'name' => $name];

        $this->scheduleStorageMock
            ->shouldReceive('getById')
            ->with($id)
            ->andReturn($data);

        $entity = $this->scheduleRepository->getById($id);
        $tester->assertEquals($id, $entity->getId());
        $tester->assertEquals($startTime, $entity->getStartTime()->getTimestamp());
        $tester->assertEquals($endTime, $entity->getEndTime()->getTimestamp());
    }

    /**
     * @param \UnitTester $tester
     */
    public function testGetByIdFail(\UnitTester $tester)
    {
        $this->scheduleStorageMock
            ->shouldReceive('getById')
            ->with(9)
            ->andReturn([]);

        $tester->expectThrowable(StorageDataMissingException::class, function () {
            $this->scheduleRepository->getById(9);
        });
    }

    /**
     * @return array[]
     */
    protected function schedulesProvider()
    {
        return [
            ['id' => 1, 'start_time' => 1631232000, 'end_time' => 1631232000 + 86400, 'name' => 'Test'],
        ];
    }
}