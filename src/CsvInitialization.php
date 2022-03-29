<?php

namespace FormRelay\Csv;

use FormRelay\Core\Initialization;
use FormRelay\Csv\DataDispatcher\CsvDataDispatcher;
use FormRelay\Csv\Route\CsvRoute;


class CsvInitialization extends Initialization
{
    const DATA_DISPATCHERS = [
        CsvDataDispatcher::class,
    ];
    const ROUTES = [
        CsvRoute::class,
    ];
}
