<?php
declare(strict_types=1);

namespace AdventOfCode\Day10;

use PHPUnit\Framework\TestCase;

class KnotingTest extends TestCase
{
    /**
     * @var Knoting
     */
    private $knoting;

    public function testClassExists()
    {
        $this->assertInstanceOf(Knoting::class, $this->knoting);
    }

    public function testProcess1()
    {
        $this->assertSame(2, $this->knoting->process([3]));
    }

    public function testProcess2()
    {
        $this->assertSame(12, $this->knoting->process([3, 4]));
    }

    public function testProcess()
    {
        $this->knoting->process([3, 4, 1, 5]);
        $this->assertSame([0, 3, 4, 2, 1], $this->knoting->getList());
        $this->assertSame(4, $this->knoting->getSkip());
    }

    public function testFixture()
    {
        $this->knoting = new Knoting(255);
        $result        = $this->knoting->process([199, 0, 255, 136, 174, 254, 227, 16, 51, 85, 1, 2, 22, 17, 7, 192]);
        $this->assertSame(42230, $result);
    }

    protected function setUp()
    {
        $this->knoting = new Knoting(4);
    }

}
