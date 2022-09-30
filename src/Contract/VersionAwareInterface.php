<?php

declare(strict_types=1);

namespace RectorComposer\Contract;

interface VersionAwareInterface
{
    public function getVersion(): string;
}
