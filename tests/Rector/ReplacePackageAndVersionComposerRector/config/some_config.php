<?php

declare(strict_types=1);

use RectorComposer\Rector\ReplacePackageAndVersionComposerRector;
use RectorComposer\ValueObject\ReplacePackageAndVersion;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(__DIR__ . '/../../../../config/config.php');
    $rectorConfig
        ->ruleWithConfiguration(
            ReplacePackageAndVersionComposerRector::class,
            [new ReplacePackageAndVersion('vendor1/package1', 'vendor1/package3', '^4.0')]
        );
};