<?php
declare(strict_types=1);

namespace AdventOfCode\Day3;

use PHPUnit\Framework\TestCase;

class ArrayCreatorTest extends TestCase
{
    /**
     * @var ArrayCreator
     */
    private $creator;

    protected function setUp()
    {
        $this->creator = new ArrayCreator();
    }


    public function testCreate1()
    {
        $this->assertSame([[1]], $this->creator->create(1));
    }

    public function testCreate2()
    {
        $this->assertSame([0 => [0 => 1], 1 => [2]], $this->creator->create(2));
    }

    public function testCreate9()
    {
        $this->assertEquals([
            -1 => [-1 => 5, 0 => 6, 1 => 7],
            0  => [-1 => 4, 0 => 1, 1 => 8],
            1  => [-1 => 3, 0 => 2, 1 => 9],
        ], $this->creator->create(9));
    }

    /**
     * @dataProvider provideCellsAndSteps
     */
    public function testStepCounter(int $cell, int $steps)
    {
        $this->assertSame($steps, $this->creator->countSteps($cell));
    }

    public function provideCellsAndSteps(): array
    {
        return [
            [1, 0],
            [12, 3],
            [23, 2],
            [1024, 31],
            [312051, 430]
        ];
    }
}
