<?php

declare(strict_types=1);

namespace RectorComposer\Tests\Rector\RenamePackageComposerRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class RenamePackageComposerRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(string $file): void
    {
        $this->doTestFile($file);
    }

    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture', '*.json');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/some_config.php';
    }
}
