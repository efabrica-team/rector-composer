<?php

declare(strict_types=1);

namespace RectorComposer\Guard;

use Composer\Semver\VersionParser;
use RectorComposer\Contract\VersionAwareInterface;

final class VersionGuard
{
    public function __construct(
        private readonly VersionParser $versionParser
    ) {
    }

    /**
     * @param VersionAwareInterface[] $versionAwares
     */
    public function validate(array $versionAwares): void
    {
        foreach ($versionAwares as $versionAware) {
            $this->versionParser->parseConstraints($versionAware->getVersion());
        }
    }
}
