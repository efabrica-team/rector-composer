<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorComposer\Rector\AddPackageToRequireComposerRector;
use RectorComposer\ValueObject\PackageAndVersion;
use RectorComposer\ValueObject\RectorComposerConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(RectorComposerConfig::FILE_PATH);
    $rectorConfig
        ->ruleWithConfiguration(
            AddPackageToRequireComposerRector::class,
            [new PackageAndVersion('vendor1/package3', '^3.0')]
        );
};
