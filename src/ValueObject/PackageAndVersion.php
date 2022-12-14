<?php

declare(strict_types=1);

namespace RectorComposer\ValueObject;

use RectorComposer\Contract\VersionAwareInterface;

final class PackageAndVersion implements VersionAwareInterface
{
    public function __construct(
        private readonly string $packageName,
        private readonly string $version
    ) {
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }

    public function getVersion(): string
    {
        return $this->version;
    }
}
