<?php
declare(strict_types=1);

namespace AdventOfCode\Day4;

use PHPUnit\Framework\TestCase;

class PasswordFilterTest extends TestCase
{
    /**
     * @var PasswordFilter
     */
    private $filter;

    protected function setUp()
    {
        $this->filter = new PasswordFilter();
    }

    public function testFilter()
    {
        $input = [
            'aa bb cc dd ee',
            'aa bb cc dd aa',
            'aa bb cc dd aaa',
        ];
        $this->assertEquals(2, $this->filter->countValidPasswords($input));
    }

    public function testFixture()
    {
        $input = array_map('trim', array_filter(file(__DIR__ . '/password.fixture')));
        $this->assertEquals(325, $this->filter->countValidPasswords($input));
    }

    public function testHarderFilter()
    {
        $input = [
            'abcde fghij',
            'abcde xyz ecdab',
            'a ab abc abd abf abj',
            'iiii oiii ooii oooi oooo',
            'oiii ioii iioi iiio',
        ];
        $this->assertEquals(3, $this->filter->countValidHardPasswords($input));
    }

    public function testFixtureHard()
    {
        $input = array_map('trim', array_filter(file(__DIR__ . '/password.fixture')));
        $this->assertEquals(119, $this->filter->countValidHardPasswords($input));
    }
}
