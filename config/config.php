<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void
{

    $services = $rectorConfig->services();

    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->load('RectorComposer\\', __DIR__ . '/../src')
        ->exclude([__DIR__ . '/../src/Contract', __DIR__ . '/../src/Rector', __DIR__ . '/../src/ValueObject']);
};
