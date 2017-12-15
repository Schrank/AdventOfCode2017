<?php
declare(strict_types=1);

namespace AdventOfCode\Day5;

use PHPUnit\Framework\TestCase;

class JumperTest extends TestCase
{
    /**
     * @var Jumper
     */
    private $jumper;

    protected function setUp()
    {
        $this->jumper = new Jumper();
    }

    public function testNoInstruction()
    {
        $input = [];
        $this->assertEquals(0, $this->jumper->process($input));
    }

    public function testSingleInstruction()
    {
        $input = [1];
        $this->assertEquals(1, $this->jumper->process($input));
    }

    public function testInput()
    {
        $input = [0, 3, 0, 1, -3];
        $this->assertEquals(5, $this->jumper->process($input));
    }

    public function testOnFixture()
    {
        $input = array_map('trim', file(__DIR__ . '/input.fixture'));
        $this->assertEquals(372139, $this->jumper->process($input));
    }

    public function testProcessOnStrangeRules()
    {
        $input = [0, 3, 0, 1, -3];
        $this->assertEquals(10, $this->jumper->processStrange($input));
    }

    public function testStrangeFixture()
    {
        $input = array_map('trim', file(__DIR__ . '/input.fixture'));
        $this->assertEquals(29629538, $this->jumper->processStrange($input));
    }

}

