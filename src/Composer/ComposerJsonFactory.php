<?php

declare(strict_types=1);

namespace RectorComposer\Composer;

use Symplify\ComposerJsonManipulator\ValueObject\ComposerJson;
use Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection;

final class ComposerJsonFactory
{
    public static function createFromFilePath(string $filePath): ComposerJson
    {
        $content = file_get_contents($filePath) ?: '';
        return self::createFromContent($content);
    }

    public static function createFromContent(string $content): ComposerJson
    {
        return self::createFromArray(json_decode($content, true));
    }

    /**
     * @param mixed[] $jsonArray
     */
    public static function createFromArray(array $jsonArray): ComposerJson
    {
        $composerJson = new ComposerJson();

        if (isset($jsonArray[ComposerJsonSection::CONFIG])) {
            $composerJson->setConfig($jsonArray[ComposerJsonSection::CONFIG]);
        }

        if (isset($jsonArray[ComposerJsonSection::NAME])) {
            $composerJson->setName($jsonArray[ComposerJsonSection::NAME]);
        }

        if (isset($jsonArray[ComposerJsonSection::TYPE])) {
            $composerJson->setType($jsonArray[ComposerJsonSection::TYPE]);
        }

        if (isset($jsonArray[ComposerJsonSection::AUTHORS])) {
            $composerJson->setAuthors($jsonArray[ComposerJsonSection::AUTHORS]);
        }

        if (isset($jsonArray[ComposerJsonSection::DESCRIPTION])) {
            $composerJson->setDescription($jsonArray[ComposerJsonSection::DESCRIPTION]);
        }

        if (isset($jsonArray[ComposerJsonSection::KEYWORDS])) {
            $composerJson->setKeywords($jsonArray[ComposerJsonSection::KEYWORDS]);
        }

        if (isset($jsonArray[ComposerJsonSection::HOMEPAGE])) {
            $composerJson->setHomepage($jsonArray[ComposerJsonSection::HOMEPAGE]);
        }

        if (isset($jsonArray[ComposerJsonSection::LICENSE])) {
            $composerJson->setLicense($jsonArray[ComposerJsonSection::LICENSE]);
        }

        if (isset($jsonArray[ComposerJsonSection::BIN])) {
            $composerJson->setBin($jsonArray[ComposerJsonSection::BIN]);
        }

        if (isset($jsonArray[ComposerJsonSection::REQUIRE])) {
            $composerJson->setRequire($jsonArray[ComposerJsonSection::REQUIRE]);
        }

        if (isset($jsonArray[ComposerJsonSection::REQUIRE_DEV])) {
            $composerJson->setRequireDev($jsonArray[ComposerJsonSection::REQUIRE_DEV]);
        }

        if (isset($jsonArray[ComposerJsonSection::AUTOLOAD])) {
            $composerJson->setAutoload($jsonArray[ComposerJsonSection::AUTOLOAD]);
        }

        if (isset($jsonArray[ComposerJsonSection::AUTOLOAD_DEV])) {
            $composerJson->setAutoloadDev($jsonArray[ComposerJsonSection::AUTOLOAD_DEV]);
        }

        if (isset($jsonArray[ComposerJsonSection::REPLACE])) {
            $composerJson->setReplace($jsonArray[ComposerJsonSection::REPLACE]);
        }

        if (isset($jsonArray[ComposerJsonSection::EXTRA])) {
            $composerJson->setExtra($jsonArray[ComposerJsonSection::EXTRA]);
        }

        if (isset($jsonArray[ComposerJsonSection::SCRIPTS])) {
            $composerJson->setScripts($jsonArray[ComposerJsonSection::SCRIPTS]);
        }

        if (isset($jsonArray[ComposerJsonSection::SCRIPTS_DESCRIPTIONS])) {
            $composerJson->setScriptsDescriptions($jsonArray[ComposerJsonSection::SCRIPTS_DESCRIPTIONS]);
        }

        if (isset($jsonArray[ComposerJsonSection::SUGGEST])) {
            $composerJson->setSuggest($jsonArray[ComposerJsonSection::SUGGEST]);
        }

        if (isset($jsonArray[ComposerJsonSection::MINIMUM_STABILITY])) {
            $composerJson->setMinimumStability($jsonArray[ComposerJsonSection::MINIMUM_STABILITY]);
        }

        if (isset($jsonArray[ComposerJsonSection::PREFER_STABLE])) {
            $composerJson->setPreferStable($jsonArray[ComposerJsonSection::PREFER_STABLE]);
        }

        if (isset($jsonArray[ComposerJsonSection::CONFLICT])) {
            $composerJson->setConflicts($jsonArray[ComposerJsonSection::CONFLICT]);
        }

        if (isset($jsonArray[ComposerJsonSection::REPOSITORIES])) {
            $composerJson->setRepositories($jsonArray[ComposerJsonSection::REPOSITORIES]);
        }

        if (isset($jsonArray[ComposerJsonSection::VERSION])) {
            $composerJson->setVersion($jsonArray[ComposerJsonSection::VERSION]);
        }

        if (isset($jsonArray[ComposerJsonSection::PROVIDE])) {
            $composerJson->setProvide($jsonArray[ComposerJsonSection::PROVIDE]);
        }

        $orderedKeys = array_keys($jsonArray);
        $composerJson->setOrderedKeys($orderedKeys);

        return $composerJson;
    }
}
