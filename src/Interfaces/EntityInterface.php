<?php
namespace Tymeshift\PhpTest\Interfaces;

interface EntityInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self;
}
