<?php

declare(strict_types=1);

namespace RectorComposer\Application\FileProcessor;

use Rector\ChangesReporting\ValueObjectFactory\FileDiffFactory;
use Rector\Core\Contract\Processor\FileProcessorInterface;
use Rector\Core\ValueObject\Application\File;
use Rector\Core\ValueObject\Configuration;
use Rector\Core\ValueObject\Error\SystemError;
use Rector\Core\ValueObject\Reporting\FileDiff;
use Rector\Parallel\ValueObject\Bridge;
use Rector\Testing\PHPUnit\StaticPHPUnitEnvironment;
use RectorComposer\Composer\ComposerJsonFactory;
use RectorComposer\Contract\Rector\ComposerRectorInterface;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ComposerFileProcessor implements FileProcessorInterface
{
    /**
     * @param ComposerRectorInterface[] $composerRectors
     */
    public function __construct(
        private readonly FileDiffFactory $fileDiffFactory,
        private readonly array $composerRectors
    ) {
    }

    /**
     * @return array{system_errors: SystemError[], file_diffs: FileDiff[]}
     */
    public function process(File $file, Configuration $configuration): array
    {
        $systemErrorsAndFileDiffs = [
            Bridge::SYSTEM_ERRORS => [],
            Bridge::FILE_DIFFS => [],
        ];

        if ($this->composerRectors === []) {
            return $systemErrorsAndFileDiffs;
        }

        // to avoid modification of file
        $smartFileInfo = new SmartFileInfo($file->getFilePath());
        $oldFileContents = $smartFileInfo->getContents();
        $composerJson = ComposerJsonFactory::createFromContent($oldFileContents);

        $oldComposerJson = clone $composerJson;
        foreach ($this->composerRectors as $composerRector) {
            $composerRector->refactor($composerJson);
        }

        // nothing has changed
        if ($oldComposerJson->getJsonArray() === $composerJson->getJsonArray()) {
            return $systemErrorsAndFileDiffs;
        }

        $changedFileContent = json_encode($composerJson->getJsonArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n";
        $file->changeFileContent($changedFileContent);

        $fileDiff = $this->fileDiffFactory->createFileDiff($file, $oldFileContents, $changedFileContent);

        $systemErrorsAndFileDiffs[Bridge::FILE_DIFFS] = [$fileDiff];

        return $systemErrorsAndFileDiffs;
    }

    public function supports(File $file, Configuration $configuration): bool
    {
        $smartFileInfo = new SmartFileInfo($file->getFilePath());

        if ($this->isJsonInTests($smartFileInfo)) {
            return true;
        }

        return $smartFileInfo->getBasename() === 'composer.json';
    }

    /**
     * @return string[]
     */
    public function getSupportedFileExtensions(): array
    {
        return ['json'];
    }

    private function isJsonInTests(SmartFileInfo $fileInfo): bool
    {
        if (! StaticPHPUnitEnvironment::isPHPUnitRun()) {
            return false;
        }

        return $fileInfo->hasSuffixes(['json']);
    }
}
