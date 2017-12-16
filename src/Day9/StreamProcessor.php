<?php
declare(strict_types=1);

namespace AdventOfCode\Day9;

class StreamProcessor
{
    /**
     * @var int
     */
    private $garbageCount;

    public function process(string $input): int
    {
        do {
            $input = preg_replace('#!.#', '', $input, -1, $count);
        } while ($count);

        do {
            preg_match_all('#<(.*?)>#', $input, $matches);
            $this->garbageCount += array_reduce($matches[1], function (int $carry, string $value) {
                return strlen($value) + $carry;
            }, 0);
            $input              = preg_replace('#<.*?>#', '', $input, -1, $count);
        } while ($count);

        $chars = str_split($input);
        $depth = 1;
        $score = 0;
        foreach ($chars as $char) {
            if ($char === '{') {
                $score += $depth++;
            }
            if ($char === '}') {
                $depth--;
            }
        }
        return $score;
    }

    public function getGarbageCount()
    {
        return $this->garbageCount;
    }
}
