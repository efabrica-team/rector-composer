<?php

declare(strict_types=1);

use RectorComposer\Rector\RenamePackageComposerRector;
use RectorComposer\ValueObject\RenamePackage;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void
{
    $rectorConfig->import(__DIR__ . '/../../../../config/config.php');
    $rectorConfig
        ->ruleWithConfiguration(
            RenamePackageComposerRector::class,
            [new RenamePackage('foo/bar', 'baz/bar'), new RenamePackage('foo/baz', 'baz/baz')]
        );
};
