<?php

declare(strict_types=1);

use RectorComposer\Rector\RemovePackageComposerRector;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(__DIR__ . '/../../../../config/config.php');
    $rectorConfig
        ->ruleWithConfiguration(
            RemovePackageComposerRector::class,
            ['vendor1/package3', 'vendor1/package1', 'vendor1/package2']
        );
};
