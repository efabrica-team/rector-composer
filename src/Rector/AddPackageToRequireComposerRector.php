<?php

declare(strict_types=1);

namespace RectorComposer\Rector;

use RectorComposer\Contract\Rector\ComposerRectorInterface;
use RectorComposer\Guard\VersionGuard;
use RectorComposer\ValueObject\PackageAndVersion;
use Symplify\ComposerJsonManipulator\ValueObject\ComposerJson;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see \RectorComposer\Tests\Rector\AddPackageToRequireComposerRector\AddPackageToRequireComposerRectorTest
 */
final class AddPackageToRequireComposerRector implements ComposerRectorInterface
{
    /**
     * @var PackageAndVersion[]
     */
    private array $packagesAndVersions = [];

    public function __construct(
        private readonly VersionGuard $versionGuard
    ) {
    }

    public function refactor(ComposerJson $composerJson): void
    {
        foreach ($this->packagesAndVersions as $packageAndVersion) {
            $composerJson->addRequiredPackage($packageAndVersion->getPackageName(), $packageAndVersion->getVersion());
        }
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Add package to "require" in `composer.json`', [new ConfiguredCodeSample(
            <<<'CODE_SAMPLE'
{
}
CODE_SAMPLE
            ,
            <<<'CODE_SAMPLE'
{
    "require": {
        "symfony/console": "^3.4"
    }
}
CODE_SAMPLE
            ,
            [new PackageAndVersion('symfony/console', '^3.4')]
        ),
        ]);
    }

    /**
     * @param mixed[] $configuration
     */
    public function configure(array $configuration): void
    {
        Assert::allIsAOf($configuration, PackageAndVersion::class);

        $this->versionGuard->validate($configuration);
        $this->packagesAndVersions = $configuration;
    }
}
