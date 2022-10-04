<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorComposer\Rector\ReplacePackageAndVersionComposerRector;
use RectorComposer\ValueObject\RectorComposerConfig;
use RectorComposer\ValueObject\ReplacePackageAndVersion;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(RectorComposerConfig::FILE_PATH);
    $rectorConfig
        ->ruleWithConfiguration(
            ReplacePackageAndVersionComposerRector::class,
            [new ReplacePackageAndVersion('vendor1/package1', 'vendor1/package3', '^4.0')]
        );
};
