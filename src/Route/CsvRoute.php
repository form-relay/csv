<?php

namespace FormRelay\Csv\Route;

use FormRelay\Core\Route\Route;
use FormRelay\Csv\DataDispatcher\CsvDataDispatcher;

class CsvRoute extends Route
{
    public const DATA_DISPATCHER_KEYWORD = 'csv';
    public const KEY_FILE = 'file';
    public const KEY_VALUE_DELIMITER = 'delimiter';
    public const KEY_VALUE_ENCLOSURE = 'enclosure';

    protected function getDispatcher()
    {
        /** @var CsvDataDispatcher $dispatcher */
        $dispatcher = $this->registry->getDataDispatcher(static::DATA_DISPATCHER_KEYWORD);

        $dispatcher->setFile($this->getConfig(static::KEY_FILE));
        $dispatcher->setDelimiter($this->getConfig(static::KEY_VALUE_DELIMITER));
        $dispatcher->setEnclosure($this->getConfig(static::KEY_VALUE_ENCLOSURE));

        return $dispatcher;
    }
}
