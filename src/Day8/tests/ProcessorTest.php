<?php
declare(strict_types=1);

namespace AdventOfCode\Day8;

use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    /**
     * @var Processor
     */
    private $processor;

    public function testIncrease()
    {
        $input = ['a inc 1 if a < 1'];
        $this->processor->process($input);
        $this->assertSame(['a' => 1], $this->processor->getRegister());
    }

    public function testDecrease()
    {
        $input = ['a dec 1 if a < 1'];
        $this->processor->process($input);
        $this->assertSame(['a' => -1], $this->processor->getRegister());
    }

    public function testIncreaseNumber()
    {
        $input = ['a inc 5 if a < 1'];
        $this->processor->process($input);
        $this->assertSame(['a' => 5], $this->processor->getRegister());
    }

    public function testIfGreaterThan()
    {
        $input = ['a inc 5 if a > 1'];
        $this->processor->process($input);
        $this->assertSame(['a' => 0], $this->processor->getRegister());
    }

    public function testIfGreaterOrEqualThan()
    {
        $input = ['a inc 5 if a >= 0'];
        $this->processor->process($input);
        $this->assertSame(['a' => 5], $this->processor->getRegister());
    }

    public function testIfEquals()
    {
        $input = ['a inc 5 if a == 0'];
        $this->processor->process($input);
        $this->assertSame(['a' => 5], $this->processor->getRegister());
    }

    public function testIfNotEquals()
    {
        $input = ['a inc 5 if a != 2'];
        $this->processor->process($input);
        $this->assertSame(['a' => 5], $this->processor->getRegister());
    }

    public function testIfLessThan()
    {
        $input = ['v inc 2 if a < 0'];
        $this->processor->process($input);
        $this->assertSame(['a' => 0, 'v' => 0], $this->processor->getRegister());
    }

    public function testIfLessOrEqualThan()
    {
        $input = ['a inc 3 if a <= 0'];
        $this->processor->process($input);
        $this->assertSame(['a' => 3], $this->processor->getRegister());
    }

    public function testIncreaseNegativeNumbers()
    {
        $input = ['a inc -5 if a < 1'];
        $this->processor->process($input);
        $this->assertSame(['a' => -5], $this->processor->getRegister());
    }

    public function testMore()
    {
        $input = [
            'b inc 5 if a > 1',
            'a inc 1 if b < 5',
            'c dec -10 if a >= 1',
            'c inc -20 if c == 10',
        ];
        $this->assertSame(1, $this->processor->process($input));
        $this->assertSame(['a' => 1, 'b' => 0, 'c' => -10], $this->processor->getRegister());
        $this->assertSame(10, $this->processor->getHighestValueEver());

    }

    public function testCompareWithNegativeNumber()
    {
        $input = ['a inc -5 if a > -1'];
        $this->processor->process($input);
        $this->assertSame(['a' => -5], $this->processor->getRegister());
    }

    public function testFixture()
    {
        $input = file(__DIR__ . '/input.fixture');
        $input = array_map('trim', $input);
        $this->assertSame(6611, $this->processor->process($input));
        $this->assertSame(6619, $this->processor->getHighestValueEver());
    }

    protected function setUp()
    {
        $this->processor = new Processor();
    }
}
