<?php
declare(strict_types=1);

namespace AdventOfCode\Day5;

class Jumper
{

    public function process($input)
    {
        $steps = 0;
        if ($input === []) {
            return $steps;
        }
        $key = 0;
        while (isset($input[$key])) {
            $steps++;
            $tmp = $input[$key];
            $input[$key]++;
            $key = $tmp + $key;
        }
        return $steps;
    }

    public function processStrange($input)
    {
        $steps = 0;
        if ($input === []) {
            return $steps;
        }
        $key = 0;
        while (isset($input[$key])) {
            $steps++;
            $tmp         = $input[$key];
            $input[$key] = $input[$key] >= 3 ? $input[$key] - 1 : $input[$key] + 1;
            $key         = $tmp + $key;
        }
        return $steps;
    }
}
