<?php

declare(strict_types=1);

use RectorComposer\Rector\ChangePackageVersionComposerRector;
use RectorComposer\Rector\ReplacePackageAndVersionComposerRector;
use RectorComposer\ValueObject\PackageAndVersion;
use RectorComposer\ValueObject\RectorComposerConfig;
use RectorComposer\ValueObject\ReplacePackageAndVersion;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(RectorComposerConfig::FILE_PATH);
    $rectorConfig
        ->ruleWithConfiguration(
            ReplacePackageAndVersionComposerRector::class,
            [new ReplacePackageAndVersion('vendor1/package2', 'vendor2/package1', '^3.0')]
        );

    $rectorConfig
        ->ruleWithConfiguration(
            ChangePackageVersionComposerRector::class,
            [new PackageAndVersion('vendor1/package3', '~3.0.0')]
        );
};
