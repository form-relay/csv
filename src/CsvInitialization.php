<?php

namespace FormRelay\Csv;

use FormRelay\Core\Initialization;
use FormRelay\Csv\DataDispatcher\CsvDataDispatcher;
use FormRelay\Csv\Route\CsvRoute;

class CsvInitialization extends Initialization
{
    public const DATA_DISPATCHERS = [
        CsvDataDispatcher::class,
    ];
    public const ROUTES = [
        CsvRoute::class,
    ];
}
