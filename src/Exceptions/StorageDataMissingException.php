<?php
declare(strict_types=1);

namespace Tymeshift\PhpTest\Exceptions;

class StorageDataMissingException extends \Exception
{
    const MESSAGE = 'No data found';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, 500);
    }
}