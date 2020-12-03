<?php
declare(strict_types=1);

namespace AdventOfCode\Day2;

use PHPUnit\Framework\TestCase;

class ChecksumTest extends TestCase
{
    public function testChecksum()
    {
        $input       = [
            '5 1 9 5',
            '7 5 3',
            '2 4 6 8',
        ];
        $checksummer = new Checksummer();
        $this->assertSame(18, $checksummer->checksum($input));
    }

    public function testFixture()
    {
        $input       = explode("\n", trim(file_get_contents(__DIR__ . '/input.fixture')));
        $checksummer = new Checksummer();
        $this->assertSame(53978, $checksummer->checksum($input));
    }

    public function testAdvancedChecksummer()
    {
        $input = [
            '5 9 2 8',
            '9 4 7 3',
            '3 8 6 5',
        ];
        $this->assertSame(9, (new AdvancedChecksummer())->checksum($input));
    }

    public function testAdvancedChecksummerAgainstFixture()
    {
        $input = explode("\n", trim(file_get_contents(__DIR__ . '/input.fixture')));
        $this->assertSame(314, (new AdvancedChecksummer())->checksum($input));
    }
}
