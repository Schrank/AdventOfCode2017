<?php
declare(strict_types=1);

namespace AdventOfCode\Day10;

class Knoting
{
    private $size;
    /**
     * @var int[]
     */
    private $list;
    /**
     * @var int
     */
    private $skip = 0;

    public function __construct(int $length)
    {
        $this->size = $length + 1;
        $this->list = range(0, $length);
    }

    public function process(array $input)
    {
        $start = 0;
        foreach ($input as $length) {
            if ($length === 0) {
                $this->skip++;
                continue;
            }
            $chunks    = array_chunk($this->list, $length);
            $chunks[0] = array_reverse($chunks[0]);

            $start      += $length + $this->skip++;
            $chunks     = array_chunk($this->arrayMerge($chunks), $start);
            $chunks[]   = array_shift($chunks);
            $this->list = $this->arrayMerge($chunks);
        }

        return $this->list[($start - 1) % $this->size] * $this->list[$start % $this->size];
    }

    public function getList(): array
    {
        return $this->list;
    }

    public function getSkip(): int
    {
        return $this->skip;
    }

    private function arrayMerge(array $chunks)
    {
        return array_reduce($chunks, function (array $carry, array $array) {
            return array_merge($carry, $array);
        }, []);
    }
}
