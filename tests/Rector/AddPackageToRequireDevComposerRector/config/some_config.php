<?php

declare(strict_types=1);

use RectorComposer\Rector\AddPackageToRequireDevComposerRector;
use RectorComposer\ValueObject\PackageAndVersion;
use Rector\Config\RectorConfig;
use RectorComposer\ValueObject\RectorComposerConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(RectorComposerConfig::FILE_PATH);
    $rectorConfig
        ->ruleWithConfiguration(AddPackageToRequireDevComposerRector::class, [
            new PackageAndVersion('vendor1/package3', '^3.0'),
            new PackageAndVersion('vendor1/package1', '^3.0'),
            new PackageAndVersion('vendor1/package2', '^3.0'),
        ]);
};
