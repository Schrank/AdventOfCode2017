<?php
declare(strict_types=1);

namespace AdventOfCode\Day2;

class AdvancedChecksummer
{
    public function checksum($input)
    {
        $input = array_map(function ($input) {
            return str_replace("\t", ' ', $input);
        }, $input);
        $sum   = 0;
        foreach ($input as $line) {
            $values = explode(' ', $line);
            foreach ($values as $a) {
                foreach ($values as $b) {
                    if ($a % $b !== 0) {
                        continue;
                    }
                    if (intdiv((int)$a, (int)$b) === 1) {
                        continue;
                    }
                    $sum += intdiv((int)$a, (int)$b);
                }
            }
        }
        return $sum;
    }
}
