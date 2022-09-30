<?php

declare(strict_types=1);

use RectorComposer\Rector\AddPackageToRequireDevComposerRector;
use RectorComposer\ValueObject\PackageAndVersion;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(__DIR__ . '/../../../../config/config.php');
    $rectorConfig
        ->ruleWithConfiguration(AddPackageToRequireDevComposerRector::class, [
            new PackageAndVersion('vendor1/package3', '^3.0'),
            new PackageAndVersion('vendor1/package1', '^3.0'),
            new PackageAndVersion('vendor1/package2', '^3.0'),
        ]);
};
