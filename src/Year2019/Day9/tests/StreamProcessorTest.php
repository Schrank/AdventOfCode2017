<?php
declare(strict_types=1);

namespace AdventOfCode\Day9;

use PHPUnit\Framework\TestCase;

class StreamProcessorTest extends TestCase
{
    /**
     * @var StreamProcessor
     */
    private $processor;

    protected function setUp()
    {
        $this->processor = new StreamProcessor();
    }

    /**
     * @dataProvider provideInput
     */
    public function testProcessing(string $input, int $groupCount)
    {
        $this->assertSame($groupCount, $this->processor->process($input));
    }

    public function provideInput()
    {
        $sets = [
            ['{{{}}}', 6,],
            ['{{},{}}', 5],
            ['{{{},{},{{}}}}', 16],
            ['{<a>,<a>,<a>,<a>}', 1],
            ['{{<ab>},{<ab>},{<ab>},{<ab>}}', 9],
            ['{{<!!>},{<!!>},{<!!>},{<!!>}}', 9],
            ['{{<a!>},{<a!>},{<a!>},{<ab>}}', 3],
        ];
        return array_reduce($sets, function ($result, $item) {
            $result[$item[0]] = $item;
            return $result;
        }, []);
    }

    /**
     * @dataProvider provideGarbage
     */
    public function testGarbageCounter(string $input, int $garbaceCount)
    {
        $this->processor->process($input);
        $this->assertSame($garbaceCount, $this->processor->getGarbageCount());
    }

    public function provideGarbage()
    {
        $sets = [
            ['<>', 0],
            ['<random characters>', 17],
            ['<<<<>', 3],
            ['<{!>}>', 2],
            ['<!!>', 0],
            ['<!!!>>', 0],
            ['<{o"i!a,<{i<a>', 10],
        ];
        return array_reduce($sets, function ($result, $item) {
            $result[$item[0]] = $item;
            return $result;
        }, []);
    }

    public function testFixture()
    {
        $input = file_get_contents(__DIR__ . '/stream.fixture');
        $this->assertSame(17537, $this->processor->process($input));
    }

    public function testCountGarbageInFixture()
    {
        $input = file_get_contents(__DIR__ . '/stream.fixture');
        $this->processor->process($input);
        $this->assertSame(7539, $this->processor->getGarbageCount());
    }
}
