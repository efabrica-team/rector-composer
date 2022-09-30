<?php

declare(strict_types=1);

namespace RectorComposer\ValueObject;

use RectorComposer\Contract\VersionAwareInterface;
use RectorComposer\Rector\ChangePackageVersionComposerRector;
use Webmozart\Assert\Assert;

final class ReplacePackageAndVersion implements VersionAwareInterface
{
    private readonly string $oldPackageName;

    private readonly string $newPackageName;

    public function __construct(
        string $oldPackageName,
        string $newPackageName,
        private readonly string $version
    ) {
        Assert::notSame(
            $oldPackageName,
            $newPackageName,
            'Old and new package have to be different. If you want to only change package version, use ' . ChangePackageVersionComposerRector::class
        );

        $this->oldPackageName = $oldPackageName;
        $this->newPackageName = $newPackageName;
    }

    public function getOldPackageName(): string
    {
        return $this->oldPackageName;
    }

    public function getNewPackageName(): string
    {
        return $this->newPackageName;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}
