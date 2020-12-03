<?php
declare(strict_types=1);

namespace AdventOfCode\Day6;

use PHPUnit\Framework\TestCase;

class ReallocatorTest extends TestCase
{
    /**
     * @var Reallocator
     */
    private $reallocator;

    protected function setUp()
    {
        $this->reallocator = new Reallocator();
    }

    public function testReallocation()
    {
        $input = [0, 2, 7, 0];
        $this->assertSame(5, $this->reallocator->reallocate($input));
    }

    public function testReallocationOnFixture()
    {
        return $this->markTestIncomplete('Runs too long.');
        $input = [14, 0, 15, 12, 11, 11, 3, 5, 1, 6, 8, 4, 9, 1, 8, 4];
        $this->assertSame(11137, $this->reallocator->reallocate($input));
    }

    public function testLoopSize()
    {
        $input = [0, 2, 7, 0];
        $this->reallocator->reallocate($input);
        $this->assertSame(4, $this->reallocator->getLoopSize());
    }

    public function testLoopSizeOnFixture()
    {
        return $this->markTestIncomplete('Runs too long.');
        $input = [14, 0, 15, 12, 11, 11, 3, 5, 1, 6, 8, 4, 9, 1, 8, 4];
        $this->reallocator->reallocate($input);
        $this->assertSame(1037, $this->reallocator->getLoopSize());
    }
}
