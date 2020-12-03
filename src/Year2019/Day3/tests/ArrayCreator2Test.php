<?php
declare(strict_types=1);

namespace AdventOfCode\Day3;

use PHPUnit\Framework\TestCase;

class ArrayCreator2Test extends TestCase
{
    /**
     * @var ArrayCreator
     */
    private $creator;

    protected function setUp()
    {
        $this->creator = new ArrayCreator2();
    }

    public function testCreate9()
    {
        $this->assertEquals([
            -1 => [-1 => 5, 0 => 10, 1 => 11],
            0  => [-1 => 4, 0 => 1, 1 => 23],
            1  => [-1 => 2, 0 => 1, 1 => 25],
        ], $this->creator->create(9));
    }

    public function testCreate312051()
    {
        $this->expectExceptionMessage('Value 312453 is higher then 312051.');
        $this->creator->create(312051);
    }
}
