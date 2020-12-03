<?php
declare(strict_types=1);

namespace AdventOfCode\Year2020\Day3;

use PHPUnit\Framework\TestCase;

class WayFinderTest extends TestCase
{
    private WayFinder $finder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->finder = new WayFinder();
    }

    public function testOneStep(): void
    {
//            '####',
//            '###O',
//            '####',

        $map = implode("\n", [
            '####',
            '####',
            '####',
        ]);

        $this->assertSame(2, $this->finder->find($map));
    }

    public function testOneStepWithoutTrees(): void
    {
        $map = implode("\n", [
            '....',
            '....',
            '....',
        ]);

        $this->assertSame(0, $this->finder->find($map));
    }

    public function testOneLine(): void
    {
        $map = implode("\n", [
            '#',
            '#',
            '#',
            '#',
            '#',
            '#',
        ]);

        $this->assertSame(5, $this->finder->find($map));
    }

    public function testOneLineWithoutOneTree(): void
    {
        $map = implode("\n", [
            '#',
            '#',
            '.',
            '#',
            '#',
            '#',
        ]);

        $this->assertSame(4, $this->finder->find($map));
    }

    public function testExample(): void
    {
        $map = implode("\n", [
            '..##.......',
            '#...#...#..',
            '.#....#..#.',
            '..#.#...#.#',
            '.#...##..#.',
            '..#.##.....',
            '.#.#.#....#',
            '.#........#',
            '#.##...#...',
            '#...##....#',
            '.#..#...#.#',
        ]);

        $this->assertSame(7, $this->finder->find($map));
    }

    public function testPuzzle1(): void
    {
        $input = file_get_contents(__DIR__ . '/puzzle1.txt');
        $count = $this->finder->find($input);
        $this->assertTrue(true);
        fwrite(STDERR, print_r('Trees in the way: ' . $count . "\n", true));
    }

    public function testPuzzle2(): void
    {
        $input   = file_get_contents(__DIR__ . '/puzzle2.txt');
        $count[] = $this->finder->find($input, 1, 1);
        $count[] = $this->finder->find($input, 3, 1);
        $count[] = $this->finder->find($input, 5, 1);
        $count[] = $this->finder->find($input, 7, 1);
        $count[] = $this->finder->find($input, 1, 2);

        $this->assertTrue(true);
        fwrite(STDERR, print_r('Trees in the way: ' . array_product($count) . "\n", true));
    }
}
