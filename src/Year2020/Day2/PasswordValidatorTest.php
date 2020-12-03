<?php
declare(strict_types=1);

namespace AdventOfCode\Year2020\Day2;

use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    private PasswordValidator $validator;

    protected function setUp()
    {
        parent::setUp();
        $this->validator = new PasswordValidator();
    }

    public function test11()
    {
        $this->assertTrue($this->validator->validate('1-3 a: abcde'));
    }

    public function test12()
    {
        $this->assertFalse($this->validator->validate('1-3 b: cdefg'));
    }

    public function test13()
    {
        $this->assertTrue($this->validator->validate('2-9 c: ccccccccc'));
    }

    public function testPuzzle1()
    {
        $input = file(__DIR__ . '/puzzle1.txt');
        $count = 0;
        foreach ($input as $line) {
            if ($this->validator->validate($line)) {
                $count++;
            }
        }
        $this->assertTrue(true);
        fwrite(STDERR, print_r('Valid passwords: ' . $count . "\n", true));
    }

    public function test21()
    {
        $this->assertTrue($this->validator->validate2('1-3 a: abcde'));
    }

    public function test22()
    {
        $this->assertFalse($this->validator->validate2('1-3 b: cdefg'));
    }

    public function test23()
    {
        $this->assertFalse($this->validator->validate2('2-9 c: ccccccccc'));
    }

    public function testPuzzle2()
    {
        $input = file(__DIR__ . '/puzzle2.txt');
        $count = 0;
        foreach ($input as $line) {
            if ($this->validator->validate2($line)) {
                $count++;
            }
        }
        $this->assertTrue(true);
        fwrite(STDERR, print_r('Valid passwords: ' . $count . "\n", true));
    }

}
