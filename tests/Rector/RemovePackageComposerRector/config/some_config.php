<?php

declare(strict_types=1);

use RectorComposer\Rector\RemovePackageComposerRector;
use Rector\Config\RectorConfig;
use RectorComposer\ValueObject\RectorComposerConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(RectorComposerConfig::FILE_PATH);
    $rectorConfig
        ->ruleWithConfiguration(
            RemovePackageComposerRector::class,
            ['vendor1/package3', 'vendor1/package1', 'vendor1/package2']
        );
};
