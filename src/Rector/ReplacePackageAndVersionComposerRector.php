<?php

declare(strict_types=1);

namespace RectorComposer\Rector;

use RectorComposer\Contract\Rector\ComposerRectorInterface;
use RectorComposer\Guard\VersionGuard;
use RectorComposer\ValueObject\ReplacePackageAndVersion;
use Symplify\ComposerJsonManipulator\ValueObject\ComposerJson;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see \RectorComposer\Tests\Rector\ReplacePackageAndVersionComposerRector\ReplacePackageAndVersionComposerRectorTest
 */
final class ReplacePackageAndVersionComposerRector implements ComposerRectorInterface
{
    /**
     * @var ReplacePackageAndVersion[]
     */
    private array $replacePackagesAndVersions = [];

    public function __construct(
        private readonly VersionGuard $versionGuard
    ) {
    }

    public function refactor(ComposerJson $composerJson): void
    {
        foreach ($this->replacePackagesAndVersions as $replacePackageAndVersion) {
            $composerJson->replacePackage(
                $replacePackageAndVersion->getOldPackageName(),
                $replacePackageAndVersion->getNewPackageName(),
                $replacePackageAndVersion->getVersion()
            );
        }
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Change package name and version `composer.json`', [new ConfiguredCodeSample(
            <<<'CODE_SAMPLE'
{
    "require-dev": {
        "symfony/console": "^3.4"
    }
}
CODE_SAMPLE
            ,
            <<<'CODE_SAMPLE'
{
    "require-dev": {
        "symfony/http-kernel": "^4.4"
    }
}
CODE_SAMPLE
            ,
            [new ReplacePackageAndVersion('symfony/console', 'symfony/http-kernel', '^4.4')]
        ),
        ]);
    }

    /**
     * @param mixed[] $configuration
     */
    public function configure(array $configuration): void
    {
        Assert::allIsAOf($configuration, ReplacePackageAndVersion::class);

        $this->versionGuard->validate($configuration);
        $this->replacePackagesAndVersions = $configuration;
    }
}
