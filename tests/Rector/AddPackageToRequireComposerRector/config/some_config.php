<?php

declare(strict_types=1);

use RectorComposer\Rector\AddPackageToRequireComposerRector;
use RectorComposer\ValueObject\PackageAndVersion;
use Rector\Config\RectorConfig;
use RectorComposer\ValueObject\RectorComposerConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(RectorComposerConfig::FILE_PATH);
    $rectorConfig
        ->ruleWithConfiguration(
            AddPackageToRequireComposerRector::class,
            [new PackageAndVersion('vendor1/package3', '^3.0')]
        );
};
