<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorComposer\Rector\RenamePackageComposerRector;
use RectorComposer\ValueObject\RectorComposerConfig;
use RectorComposer\ValueObject\RenamePackage;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(RectorComposerConfig::FILE_PATH);
    $rectorConfig
        ->ruleWithConfiguration(
            RenamePackageComposerRector::class,
            [new RenamePackage('foo/bar', 'baz/bar'), new RenamePackage('foo/baz', 'baz/baz')]
        );
};
